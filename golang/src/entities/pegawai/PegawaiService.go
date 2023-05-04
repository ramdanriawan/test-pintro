package pegawai

import (
	"fmt"
	"strconv"

	dto "skyshi.com/src/entities/pegawai/dto"

	"github.com/gin-gonic/gin"
	"github.com/go-playground/validator/v10"
)

type Pegawaiservice interface {
	GetAll() []PegawaiModel
	GetByID(id int64) PegawaiModel
	Create(ctx *gin.Context) (*PegawaiModel, error)
	Update(ctx *gin.Context) (*PegawaiModel, error)
	Delete(ctx *gin.Context) (*PegawaiModel, error)
}

type PegawaiserviceImpl struct {
	pegawaiRepository PegawaiRepository
}

func NewPegawaiService(pegawaiRepository PegawaiRepository) Pegawaiservice {
	return &PegawaiserviceImpl{pegawaiRepository}
}

func (us *PegawaiserviceImpl) GetAll() []PegawaiModel {
	return us.pegawaiRepository.FindAll()
}

func (us *PegawaiserviceImpl) GetByID(id int64) PegawaiModel {
	return us.pegawaiRepository.FindOne(id)
}

func (us *PegawaiserviceImpl) Create(ctx *gin.Context) (*PegawaiModel, error) {
	var input dto.PegawaiCreateDto

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

	pegawai := PegawaiModel{
		Nama:          input.Nama,
		TanggalLahir:  input.TanggalLahir,
		TempatLahir:   input.TempatLahir,
		JenisKelamin:  input.JenisKelamin,
		Agama:         input.Agama,
		Alamat:        input.Alamat,
		NoTelp:        input.NoTelp,
		TglMulaiKerja: input.TglMulaiKerja,
		Status:        input.Status,
	}

	result, err := us.pegawaiRepository.Save(pegawai)

	if err != nil {
		return nil, err
	}

	return result, nil
}

func (us *PegawaiserviceImpl) Update(ctx *gin.Context) (*PegawaiModel, error) {
	id, _ := strconv.Atoi(ctx.Param("id"))

	var input dto.PegawaiUpdateDto

	if err := ctx.ShouldBindJSON(&input); err != nil {
		return nil, err
	}

	validate := validator.New()

	err := validate.Struct(input)

	if err != nil {
		return nil, err
	}

	pegawai := PegawaiModel{
		ID:            int(id),
		Nama:          input.Nama,
		TanggalLahir:  input.TanggalLahir,
		TempatLahir:   input.TempatLahir,
		JenisKelamin:  input.JenisKelamin,
		Agama:         input.Agama,
		Alamat:        input.Alamat,
		NoTelp:        input.NoTelp,
		TglMulaiKerja: input.TglMulaiKerja,
		Status:        input.Status,
	}

	result, err := us.pegawaiRepository.Update(pegawai)

	if err != nil {
		return nil, err
	}

	return result, nil
}

func (us *PegawaiserviceImpl) Delete(ctx *gin.Context) (*PegawaiModel, error) {
	id, _ := strconv.Atoi(ctx.Param("id"))

	pegawai := PegawaiModel{
		ID: int(id),
	}

	result, err := us.pegawaiRepository.Delete(pegawai)

	if err != nil {
		return nil, err
	}

	return result, nil
}
