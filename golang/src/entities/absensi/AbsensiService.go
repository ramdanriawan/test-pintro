package absensi

import (
	"strconv"

	dto "skyshi.com/src/entities/absensi/dto"

	"github.com/gin-gonic/gin"
	"github.com/go-playground/validator/v10"
)

type AbsensiService interface {
	GetAll() []AbsensiModel
	GetByID(id int) AbsensiModel
	GetByEmailAndPassword(email string, password string) AbsensiModel
	Create(ctx *gin.Context) (*AbsensiModel, error)
	Update(ctx *gin.Context) (*AbsensiModel, error)
	Delete(ctx *gin.Context) (*AbsensiModel, error)
}

type AbsensiServiceImpl struct {
	absensiRepository AbsensiRepository
}

func NewAbsensiService(ordertransactionRepository AbsensiRepository) AbsensiService {
	return &AbsensiServiceImpl{ordertransactionRepository}
}

func (us *AbsensiServiceImpl) GetAll() []AbsensiModel {
	return us.absensiRepository.FindAll()
}

func (us *AbsensiServiceImpl) GetByID(id int) AbsensiModel {
	return us.absensiRepository.FindOne(id)
}

func (us *AbsensiServiceImpl) GetByEmailAndPassword(email string, password string) AbsensiModel {
	return us.absensiRepository.FindByEmailAndPassword(email, password)
}

func (us *AbsensiServiceImpl) Create(ctx *gin.Context) (*AbsensiModel, error) {
	var input dto.AbsensiCreateDto

	if err := ctx.ShouldBindJSON(&input); err != nil {
		return nil, err
	}

	validate := validator.New()

	err := validate.Struct(input)

	if err != nil {
		return nil, err
	}

	absensi := AbsensiModel{
		PegawaiId: input.PegawaiId,
		Tanggal:   input.Tanggal,
		JamMasuk:  input.JamMasuk,
		JamKeluar: input.JamKeluar,
	}

	result, err := us.absensiRepository.Save(absensi)

	if err != nil {
		return nil, err
	}

	return result, nil
}

func (us *AbsensiServiceImpl) Update(ctx *gin.Context) (*AbsensiModel, error) {
	id, _ := strconv.Atoi(ctx.Param("id"))

	var input dto.AbsensiUpdateDto

	if err := ctx.ShouldBindJSON(&input); err != nil {
		return nil, err
	}

	validate := validator.New()

	err := validate.Struct(input)

	if err != nil {
		return nil, err
	}

	absensi := AbsensiModel{
		ID:       int(id),
		PegawaiId: input.PegawaiId,
		Tanggal:   input.Tanggal,
		JamMasuk:  input.JamMasuk,
		JamKeluar: input.JamKeluar,
	}

	result, err := us.absensiRepository.Update(absensi)

	if err != nil {
		return nil, err
	}

	return result, nil
}

func (us *AbsensiServiceImpl) Delete(ctx *gin.Context) (*AbsensiModel, error) {
	id, _ := strconv.Atoi(ctx.Param("id"))

	ordertransaction := AbsensiModel{
		ID: int(id),
	}

	result, err := us.absensiRepository.Delete(ordertransaction)

	if err != nil {
		return nil, err
	}

	return result, nil
}
