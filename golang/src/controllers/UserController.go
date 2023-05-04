package controllers

import (
	"fmt"
	"log"
	"net/http"
	"strconv"
	"strings"
	"time"

	"github.com/dgrijalva/jwt-go"
	"github.com/gin-gonic/gin"
	golangjwt "github.com/golang-jwt/jwt"
	"golang.org/x/crypto/bcrypt"
	user "skyshi.com/src/entities/user"
	userdto "skyshi.com/src/entities/user/dto"
)

type UserController struct {
	userService         user.UserService
	ctx                 *gin.Context
}

func NewUserController(userService user.UserService, ctx *gin.Context) UserController {
	return UserController{userService, ctx}
}

func hashPassword(password string) (hashedPassword string) {

	hash, err := bcrypt.GenerateFromPassword([]byte(password), bcrypt.DefaultCost)
	if err != nil {
		log.Fatal(err)
	}
	fmt.Println("Hashed password", string(hash))

	return string(hash)

}

func checkPassword(hashedPassword string, password string) (isPasswordValid bool) {

	if err := bcrypt.CompareHashAndPassword([]byte(hashedPassword), []byte(password)); err != nil {
		return false
	}

	return true
}


func (uc *UserController) Authenticate(ctx *gin.Context) {
	var sampleSecretKey = []byte("SecretYouShouldHide")

	token := golangjwt.New(golangjwt.SigningMethodHS256)

	claims := token.Claims.(golangjwt.MapClaims)

	var input userdto.UserAuthenticateDto

	if err := ctx.ShouldBindJSON(&input); err != nil {
		ctx.JSON(http.StatusBadRequest, gin.H{
			"status":  "Error",
			"message": err.Error(),
		})

		return
	}

	var user = uc.userService.GetByEmailAndPassword(input.Email, input.Password)

	if user.Email == "" {
		ctx.JSON(http.StatusNotFound, gin.H{
			"status":  "Error",
			"message": "User not found",
		})

		return
	}

	claims["id"] = user.ID
	claims["exp"] = time.Now().Year() + time.Now().YearDay() + time.Now().Hour() + 1

	tokenString, err := token.SignedString(sampleSecretKey)

	if err != nil {
		ctx.JSON(http.StatusBadRequest, gin.H{
			"status":  "Error",
			"message": err.Error(),
		})

		return
	}

	ctx.JSON(http.StatusOK, gin.H{
		"status":  "Success",
		"message": "Success",
		"data":    tokenString,
	})
}

func (uc *UserController) decodeUserIdByToken(user_token string) int {
	parsedToken, _ := jwt.Parse(user_token, nil)

	claims, _ := parsedToken.Claims.(jwt.MapClaims)

	if claims["id"] == nil {
		return -1
	}

	exp := claims["exp"].(float64)

	// expired
	if exp < float64(time.Now().Year()+time.Now().YearDay()+time.Now().Hour()) {
		return -2
	}

	id := claims["id"].(float64)

	return int(id)
}

func (uc *UserController) Index(ctx *gin.Context) {
	admin_token := ctx.Query("admin_token")

	user_id := int(uc.decodeUserIdByToken(admin_token))

	if user_id < 0 {

		type DayAndTime struct {
		}

		ctx.JSON(http.StatusNotFound, gin.H{
			"status":  "Error",
			"message": "Admin token not found!",
			"data":    DayAndTime{},
		})

		return
	}

	data := uc.userService.GetAll()

	ctx.JSON(http.StatusOK, gin.H{
		"status":  "Success",
		"message": "Success",
		"data":    data,
	})
}

func (uc *UserController) GetByID(ctx *gin.Context) {
	admin_token := ctx.Query("admin_token")

	user_id := int(uc.decodeUserIdByToken(admin_token))

	if user_id < 0 {

		type DayAndTime struct {
		}

		ctx.JSON(http.StatusNotFound, gin.H{
			"status":  "Error",
			"message": "Admin token not found!",
			"data":    DayAndTime{},
		})

		return
	}

	id, _ := strconv.Atoi(ctx.Param("id"))
	data := uc.userService.GetByID(id)

	if data.ID == 0 {
		ctx.JSON(404, gin.H{
			"status":  "Not Found",
			"message": fmt.Sprintf("User with ID %d Not Found", id),
		})

		return
	}

	ctx.JSON(http.StatusOK, gin.H{
		"status":  "Success",
		"message": "Success",
		"data":    data,
	})
}



func (uc *UserController) Create(ctx *gin.Context) {
	admin_token := ctx.Query("admin_token")

	user_id := int(uc.decodeUserIdByToken(admin_token))

	if user_id < 0 {

		type DayAndTime struct {
		}

		ctx.JSON(http.StatusNotFound, gin.H{
			"status":  "Error",
			"message": "Admin token not found!",
			"data":    DayAndTime{},
		})

		return
	}

	data, err := uc.userService.Create(ctx)

	if err != nil {
		if strings.Contains(err.Error(), "Name") {

			ctx.JSON(400, gin.H{
				"status":  "Bad Request",
				"message": "name cannot be null",
			})
		} else {
			ctx.JSON(400, gin.H{
				"status":  "Bad Request",
				"message": err.Error(),
			})
		}

		ctx.Abort()

		return
	}

	ctx.JSON(201, gin.H{
		"status":  "Success",
		"message": "Success",
		"data":    data,
	})
}

func (uc *UserController) Update(ctx *gin.Context) {
	admin_token := ctx.Query("admin_token")

	user_id := int(uc.decodeUserIdByToken(admin_token))

	if user_id < 0 {

		type DayAndTime struct {
		}

		ctx.JSON(http.StatusNotFound, gin.H{
			"status":  "Error",
			"message": "Admin token not found!",
			"data":    DayAndTime{},
		})

		return
	}

	id, _ := strconv.Atoi(ctx.Param("id"))
	userModel := uc.userService.GetByID(id)

	if userModel.ID < 1 {
		ctx.JSON(http.StatusNotFound, gin.H{
			"status":  "Not Found",
			"message": fmt.Sprintf("User with ID %d Not Found", id),
		})

		ctx.Abort()

		return
	}

	_, err := uc.userService.Update(ctx)

	if err != nil {

		ctx.JSON(400, gin.H{
			"status":  "Bad Request",
			"message": err.Error(),
		})

		ctx.Abort()

		return
	}

	ctx.JSON(200, gin.H{
		"status":  "Success",
		"message": "Success",
		"data":    uc.userService.GetByID(id),
	})
}

func (uc *UserController) Delete(ctx *gin.Context) {
	admin_token := ctx.Query("admin_token")

	user_id := int(uc.decodeUserIdByToken(admin_token))

	if user_id < 0 {

		type DayAndTime struct {
		}

		ctx.JSON(http.StatusNotFound, gin.H{
			"status":  "Error",
			"message": "Admin token not found!",
			"data":    DayAndTime{},
		})

		return
	}

	id, _ := strconv.Atoi(ctx.Param("id"))
	userModel := uc.userService.GetByID(id)

	if userModel.ID < 1 {
		ctx.JSON(404, gin.H{
			"status":  "Not Found",
			"message": fmt.Sprintf("User with ID %d Not Found", id),
		})

		ctx.Abort()

		return
	}

	_, err := uc.userService.Delete(ctx)

	if err != nil {
		ctx.JSON(400, gin.H{
			"status":  "Bad Request",
			"message": err.Error(),
		})

		ctx.Abort()

		return

	}

	type ResponseData struct {
	}

	ctx.JSON(http.StatusOK, gin.H{
		"status":  "Success",
		"message": "Success",
		"data":    ResponseData{},
	})
}
