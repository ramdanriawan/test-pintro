package riwayat

import (
	"fmt"
	"strconv"

	dto "skyshi.com/src/entities/riwayat/dto"

	"github.com/gin-gonic/gin"
	"github.com/go-playground/validator/v10"
)

type Riwayatservice interface {
	GetAll() []RiwayatModel
	GetByID(id int64) RiwayatModel
	Create(ctx *gin.Context) (*RiwayatModel, error)
	Update(ctx *gin.Context) (*RiwayatModel, error)
	Delete(ctx *gin.Context) (*RiwayatModel, error)
}

type RiwayatserviceImpl struct {
	riwayatRepository RiwayatRepository
}

func NewRiwayatService(riwayatRepository RiwayatRepository) Riwayatservice {
	return &RiwayatserviceImpl{riwayatRepository}
}

func (us *RiwayatserviceImpl) GetAll() []RiwayatModel {
	return us.riwayatRepository.FindAll()
}

func (us *RiwayatserviceImpl) GetByID(id int64) RiwayatModel {
	return us.riwayatRepository.FindOne(id)
}

func (us *RiwayatserviceImpl) Create(ctx *gin.Context) (*RiwayatModel, error) {
	var input dto.RiwayatCreateDto

	if err := ctx.ShouldBindJSON(&input); err != nil {

		fmt.Println(err.Error())
		return nil, err
	}

	fmt.Println(input)

	validate := validator.New()

	err := validate.Struct(input)

	if err != nil {
		return nil, err
	}

	riwayat := RiwayatModel{
		PegawaiId:        input.PegawaiId,
		NamaJabatan:      input.NamaJabatan,
		GajiJabatan:      input.GajiJabatan,
		TunjanganJabatan: input.TunjanganJabatan,
		BonusJabatan:     input.BonusJabatan,
		NomorSk:          input.NomorSk,
		Tanggal:          input.Tanggal,
		Status:           input.Status,
	}

	result, err := us.riwayatRepository.Save(riwayat)

	if err != nil {
		return nil, err
	}

	return result, nil
}

func (us *RiwayatserviceImpl) Update(ctx *gin.Context) (*RiwayatModel, error) {
	id, _ := strconv.Atoi(ctx.Param("id"))

	var input dto.RiwayatUpdateDto

	if err := ctx.ShouldBindJSON(&input); err != nil {
		return nil, err
	}

	validate := validator.New()

	err := validate.Struct(input)

	if err != nil {
		return nil, err
	}

	riwayat := RiwayatModel{
		ID:        int(id),
		PegawaiId:        input.PegawaiId,
		NamaJabatan:      input.NamaJabatan,
		GajiJabatan:      input.GajiJabatan,
		TunjanganJabatan: input.TunjanganJabatan,
		BonusJabatan:     input.BonusJabatan,
		NomorSk:          input.NomorSk,
		Tanggal:          input.Tanggal,
		Status:           input.Status,
	}

	result, err := us.riwayatRepository.Update(riwayat)

	if err != nil {
		return nil, err
	}

	return result, nil
}

func (us *RiwayatserviceImpl) Delete(ctx *gin.Context) (*RiwayatModel, error) {
	id, _ := strconv.Atoi(ctx.Param("id"))

	riwayat := RiwayatModel{
		ID: int(id),
	}

	result, err := us.riwayatRepository.Delete(riwayat)

	if err != nil {
		return nil, err
	}

	return result, nil
}
