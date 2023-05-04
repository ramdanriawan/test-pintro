package pegawai

import (
	"gorm.io/gorm"
)

type PegawaiRepository interface {
	FindAll() []PegawaiModel
	FindOne(id int64) PegawaiModel
	Save(pegawai PegawaiModel) (*PegawaiModel, error)
	Update(pegawai PegawaiModel) (*PegawaiModel, error)
	Delete(pegawai PegawaiModel) (*PegawaiModel, error)
}

type PegawaiRepositoryImpl struct {
	db *gorm.DB
}

func NewPegawaiRepository(db *gorm.DB) PegawaiRepository {
	return &PegawaiRepositoryImpl{db}
}

func (ur *PegawaiRepositoryImpl) FindAll() []PegawaiModel {
	var pegawais []PegawaiModel

	_ = ur.db.Find(&pegawais)

	return pegawais

}

func (ur *PegawaiRepositoryImpl) FindOne(id int64) PegawaiModel {
	var pegawai PegawaiModel
	_ = ur.db.Find(&pegawai, id)

	return pegawai
}

func (ur *PegawaiRepositoryImpl) Save(pegawai PegawaiModel) (*PegawaiModel, error) {
	result := ur.db.Save(&pegawai)

	if result.Error != nil {
		return nil, result.Error
	}

	return &pegawai, nil
}

func (ur *PegawaiRepositoryImpl) Update(pegawai PegawaiModel) (*PegawaiModel, error) {

	result := ur.db.Model(&pegawai).Updates(&pegawai)

	if result.Error != nil {

		return nil, result.Error
	}

	return &pegawai, nil
}

func (ur *PegawaiRepositoryImpl) Delete(pegawai PegawaiModel) (*PegawaiModel, error) {
	result := ur.db.Delete(&pegawai)

	if result.Error != nil {
		return nil, result.Error
	}

	return &pegawai, nil
}
