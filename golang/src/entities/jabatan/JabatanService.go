package jabatan

import (
	"fmt"
	// "io/ioutil"
	"strconv"

	dto "skyshi.com/src/entities/jabatan/dto"

	"github.com/gin-gonic/gin"
	"github.com/go-playground/validator/v10"
)

type Jabatanservice interface {
	GetAll() []JabatanModel
	GetByID(id int64) JabatanModel
	Create(ctx *gin.Context) (*JabatanModel, error)
	Update(ctx *gin.Context) (*JabatanModel, error)
	Delete(ctx *gin.Context) (*JabatanModel, error)
}

type JabatanserviceImpl struct {
	jabatanRepository JabatanRepository
}

func NewJabatanService(jabatanRepository JabatanRepository) Jabatanservice {
	return &JabatanserviceImpl{jabatanRepository}
}

func (us *JabatanserviceImpl) GetAll() []JabatanModel {
	return us.jabatanRepository.FindAll()
}

func (us *JabatanserviceImpl) GetByID(id int64) JabatanModel {
	return us.jabatanRepository.FindOne(id)
}

func (us *JabatanserviceImpl) Create(ctx *gin.Context) (*JabatanModel, error) {
	var input dto.JabatanCreateDto

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

	jabatan := JabatanModel{
		Nama:      input.Nama,
		Gaji:      input.Gaji,
		Tunjangan: input.Tunjangan,
		Bonus:     input.Bonus,
	}

	result, err := us.jabatanRepository.Save(jabatan)

	if err != nil {
		return nil, err
	}

	return result, nil
}

func (us *JabatanserviceImpl) Update(ctx *gin.Context) (*JabatanModel, error) {
	id, _ := strconv.Atoi(ctx.Param("id"))

	var input dto.JabatanUpdateDto

	if err := ctx.ShouldBindJSON(&input); err != nil {
		return nil, err
	}

	validate := validator.New()

	err := validate.Struct(input)

	if err != nil {
		return nil, err
	}

	jabatan := JabatanModel{
		ID:        int(id),
		Nama:      input.Nama,
		Gaji:      input.Gaji,
		Tunjangan: input.Tunjangan,
		Bonus:     input.Bonus,
	}

	result, err := us.jabatanRepository.Update(jabatan)

	if err != nil {
		return nil, err
	}

	return result, nil
}

func (us *JabatanserviceImpl) Delete(ctx *gin.Context) (*JabatanModel, error) {
	id, _ := strconv.Atoi(ctx.Param("id"))

	jabatan := JabatanModel{
		ID: int(id),
	}

	result, err := us.jabatanRepository.Delete(jabatan)

	if err != nil {
		return nil, err
	}

	return result, nil
}
