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
	pegawai "skyshi.com/src/entities/pegawai"
)

type PegawaiController struct {
	pegawaiservice    pegawai.Pegawaiservice
	absensiservice absensi.AbsensiService
	ctx            *gin.Context
}

func NewPegawaiController(pegawaiservice pegawai.Pegawaiservice, absensiservice absensi.AbsensiService, ctx *gin.Context) PegawaiController {
	return PegawaiController{pegawaiservice, absensiservice, ctx}
}

func (uc *PegawaiController) decodeUserIdByToken(user_token string) int {
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

func (uc *PegawaiController) Index(ctx *gin.Context) {
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

	data := uc.pegawaiservice.GetAll()

	ctx.JSON(http.StatusOK, gin.H{
		"status":  "Success",
		"message": "Success",
		"data":    data,
	})
}

func (uc *PegawaiController) GetByID(ctx *gin.Context) {
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
	data := uc.pegawaiservice.GetByID(int64(id))

	type DayAndTime struct {
	}

	days := []*DayAndTime{}

	if data.ID == 0 {
		ctx.JSON(http.StatusNotFound, gin.H{
			"status":  "Not Found",
			"message": fmt.Sprintf("Pegawai with ID %d Not Found", id),
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

func (uc *PegawaiController) Create(ctx *gin.Context) {
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

	data, err := uc.pegawaiservice.Create(ctx)

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

func (uc *PegawaiController) Update(ctx *gin.Context) {
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
	pegawaiModel := uc.pegawaiservice.GetByID(int64(id))

	if pegawaiModel.ID < 1 {
		ctx.JSON(http.StatusNotFound, gin.H{
			"status":  "Not Found",
			"message": fmt.Sprintf("Pegawai with ID %d Not Found", id),
		})

		ctx.Abort()

		return
	}

	_, err := uc.pegawaiservice.Update(ctx)

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
		"data":    uc.pegawaiservice.GetByID(int64(id)),
	})
}

func (uc *PegawaiController) Delete(ctx *gin.Context) {
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
	pegawaiModel := uc.pegawaiservice.GetByID(int64(id))

	if pegawaiModel.ID < 1 {
		ctx.JSON(http.StatusNotFound, gin.H{
			"status":  "Not Found",
			"message": fmt.Sprintf("Pegawai with ID %d Not Found", id),
		})

		ctx.Abort()

		return
	}

	_, err := uc.pegawaiservice.Delete(ctx)

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
