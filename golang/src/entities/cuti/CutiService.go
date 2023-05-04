package cuti

import (
	"fmt"
	// "io/ioutil"
	"strconv"

	dto "skyshi.com/src/entities/cuti/dto"

	"github.com/gin-gonic/gin"
	"github.com/go-playground/validator/v10"
)

type Cutiservice interface {
	GetAll() []CutiModel
	GetByID(id int64) CutiModel
	Create(ctx *gin.Context) (*CutiModel, error)
	Update(ctx *gin.Context) (*CutiModel, error)
	Delete(ctx *gin.Context) (*CutiModel, error)
}

type CutiserviceImpl struct {
	cutiRepository CutiRepository
}

func NewCutiService(cutiRepository CutiRepository) Cutiservice {
	return &CutiserviceImpl{cutiRepository}
}

func (us *CutiserviceImpl) GetAll() []CutiModel {
	return us.cutiRepository.FindAll()
}

func (us *CutiserviceImpl) GetByID(id int64) CutiModel {
	return us.cutiRepository.FindOne(id)
}

func (us *CutiserviceImpl) Create(ctx *gin.Context) (*CutiModel, error) {
	var input dto.CutiCreateDto

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

	cuti := CutiModel{
		PegawaiId:       input.PegawaiId,
		NomorPermohonan: input.NomorPermohonan,
		TanggalMulai:    input.TanggalMulai,
		TanggalSelesai:  input.TanggalSelesai,
		Keterangan:      input.Keterangan,
	}

	result, err := us.cutiRepository.Save(cuti)

	if err != nil {
		return nil, err
	}

	return result, nil
}

func (us *CutiserviceImpl) Update(ctx *gin.Context) (*CutiModel, error) {
	id, _ := strconv.Atoi(ctx.Param("id"))

	var input dto.CutiUpdateDto

	if err := ctx.ShouldBindJSON(&input); err != nil {
		return nil, err
	}

	validate := validator.New()

	err := validate.Struct(input)

	if err != nil {
		return nil, err
	}

	cuti := CutiModel{
		ID:              int(id),
		PegawaiId:       input.PegawaiId,
		NomorPermohonan: input.NomorPermohonan,
		TanggalMulai:    input.TanggalMulai,
		TanggalSelesai:  input.TanggalSelesai,
		Keterangan:      input.Keterangan,
	}

	result, err := us.cutiRepository.Update(cuti)

	if err != nil {
		return nil, err
	}

	return result, nil
}

func (us *CutiserviceImpl) Delete(ctx *gin.Context) (*CutiModel, error) {
	id, _ := strconv.Atoi(ctx.Param("id"))

	cuti := CutiModel{
		ID: int(id),
	}

	result, err := us.cutiRepository.Delete(cuti)

	if err != nil {
		return nil, err
	}

	return result, nil
}
