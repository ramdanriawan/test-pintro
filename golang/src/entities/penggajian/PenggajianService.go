package penggajian

import (
	"fmt"
	"strconv"

	dto "skyshi.com/src/entities/penggajian/dto"

	"github.com/gin-gonic/gin"
	"github.com/go-playground/validator/v10"
)

type Penggajianservice interface {
	GetAll() []PenggajianModel
	GetByID(id int64) PenggajianModel
	Create(ctx *gin.Context) (*PenggajianModel, error)
	Update(ctx *gin.Context) (*PenggajianModel, error)
	Delete(ctx *gin.Context) (*PenggajianModel, error)
}

type PenggajianserviceImpl struct {
	penggajianRepository PenggajianRepository
}

func NewPenggajianService(penggajianRepository PenggajianRepository) Penggajianservice {
	return &PenggajianserviceImpl{penggajianRepository}
}

func (us *PenggajianserviceImpl) GetAll() []PenggajianModel {
	return us.penggajianRepository.FindAll()
}

func (us *PenggajianserviceImpl) GetByID(id int64) PenggajianModel {
	return us.penggajianRepository.FindOne(id)
}

func (us *PenggajianserviceImpl) Create(ctx *gin.Context) (*PenggajianModel, error) {
	var input dto.PenggajianCreateDto

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

	penggajian := PenggajianModel{
		PegawaiId: input.PegawaiId,
		Gaji:      input.Gaji,
		Tunjangan: input.Tunjangan,
		Bonus:     input.Bonus,
		Periode:   input.Periode,
		Tahun:     input.Tahun,
		Tanggal:   input.Tanggal,
		Catatan:   input.Tahun,
	}

	result, err := us.penggajianRepository.Save(penggajian)

	if err != nil {
		return nil, err
	}

	return result, nil
}

func (us *PenggajianserviceImpl) Update(ctx *gin.Context) (*PenggajianModel, error) {
	id, _ := strconv.Atoi(ctx.Param("id"))

	var input dto.PenggajianUpdateDto

	if err := ctx.ShouldBindJSON(&input); err != nil {
		return nil, err
	}

	validate := validator.New()

	err := validate.Struct(input)

	if err != nil {
		return nil, err
	}

	penggajian := PenggajianModel{
		ID:        int(id),
		PegawaiId: input.PegawaiId,
		Gaji:      input.Gaji,
		Tunjangan: input.Tunjangan,
		Bonus:     input.Bonus,
		Periode:   input.Periode,
		Tahun:     input.Tahun,
		Tanggal:   input.Tanggal,
		Catatan:   input.Tahun,
	}

	result, err := us.penggajianRepository.Update(penggajian)

	if err != nil {
		return nil, err
	}

	return result, nil
}

func (us *PenggajianserviceImpl) Delete(ctx *gin.Context) (*PenggajianModel, error) {
	id, _ := strconv.Atoi(ctx.Param("id"))

	penggajian := PenggajianModel{
		ID: int(id),
	}

	result, err := us.penggajianRepository.Delete(penggajian)

	if err != nil {
		return nil, err
	}

	return result, nil
}
