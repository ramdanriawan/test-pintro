package controllers

import (
	"fmt"
	"net/http"
	"strconv"
	"strings"
	"time"

	"github.com/dgrijalva/jwt-go"
	"github.com/gin-gonic/gin"
	absensi "skyshi.com/src/entities/absensi"
	cuti "skyshi.com/src/entities/cuti"
)

type CutiController struct {
	cutiservice    cuti.Cutiservice
	absensiservice absensi.AbsensiService
	ctx            *gin.Context
}

func NewCutiController(cutiservice cuti.Cutiservice, absensiservice absensi.AbsensiService, ctx *gin.Context) CutiController {
	return CutiController{cutiservice, absensiservice, ctx}
}

func (uc *CutiController) decodeUserIdByToken(user_token string) int {
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

func (uc *CutiController) Index(ctx *gin.Context) {
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

	type DayAndTime struct {
	}

	data := uc.cutiservice.GetAll()

	ctx.JSON(http.StatusOK, gin.H{
		"status":  "Success",
		"message": "Success",
		"data":    data,
	})
}

func (uc *CutiController) GetByID(ctx *gin.Context) {
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
	data := uc.cutiservice.GetByID(int64(id))

	type DayAndTime struct {
	}

	days := []*DayAndTime{}

	if data.ID == 0 {
		ctx.JSON(http.StatusNotFound, gin.H{
			"status":  "Not Found",
			"message": fmt.Sprintf("Cuti with ID %d Not Found", id),
			"data":    days,
		})

		return
	}

	ctx.JSON(http.StatusOK, gin.H{
		"status":  "Success",
		"message": "Success",
		"data":    data,
	})
}

func (uc *CutiController) Create(ctx *gin.Context) {
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

	data, err := uc.cutiservice.Create(ctx)

	if err != nil {

		if strings.Contains(err.Error(), "Name") {
			ctx.JSON(400, gin.H{
				"status":  "Bad Request",
				"message": "name cannot be null",
			})

		} else if strings.Contains(err.Error(), "AbsensiId") {
			ctx.JSON(400, gin.H{
				"status":  "Bad Request",
				"message": "absensi_group_id cannot be null",
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

func (uc *CutiController) Update(ctx *gin.Context) {
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
	cutiModel := uc.cutiservice.GetByID(int64(id))

	if cutiModel.ID < 1 {
		ctx.JSON(http.StatusNotFound, gin.H{
			"status":  "Not Found",
			"message": fmt.Sprintf("Cuti with ID %d Not Found", id),
		})

		ctx.Abort()

		return
	}

	_, err := uc.cutiservice.Update(ctx)

	if err != nil {

		ctx.JSON(400, gin.H{
			"status":  "Bad Request",
			"message": err.Error(),
		})

		ctx.Abort()

		return
	}

	ctx.JSON(http.StatusOK, gin.H{
		"status":  "Success",
		"message": "Success",
		"data":    uc.cutiservice.GetByID(int64(id)),
	})
}

func (uc *CutiController) Delete(ctx *gin.Context) {
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
	cutiModel := uc.cutiservice.GetByID(int64(id))

	if cutiModel.ID < 1 {
		ctx.JSON(http.StatusNotFound, gin.H{
			"status":  "Not Found",
			"message": fmt.Sprintf("Cuti with ID %d Not Found", id),
		})

		ctx.Abort()

		return
	}

	_, err := uc.cutiservice.Delete(ctx)

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
