package riwayat

import (
	"gorm.io/gorm"
)

type RiwayatRepository interface {
	FindAll() []RiwayatModel
	FindOne(id int64) RiwayatModel
	Save(riwayat RiwayatModel) (*RiwayatModel, error)
	Update(riwayat RiwayatModel) (*RiwayatModel, error)
	Delete(riwayat RiwayatModel) (*RiwayatModel, error)
}

type RiwayatRepositoryImpl struct {
	db *gorm.DB
}

func NewRiwayatRepository(db *gorm.DB) RiwayatRepository {
	return &RiwayatRepositoryImpl{db}
}

func (ur *RiwayatRepositoryImpl) FindAll() []RiwayatModel {
	var riwayats []RiwayatModel

	_ = ur.db.Find(&riwayats)

	return riwayats

}

func (ur *RiwayatRepositoryImpl) FindOne(id int64) RiwayatModel {
	var riwayat RiwayatModel
	_ = ur.db.Find(&riwayat, id)

	return riwayat
}

func (ur *RiwayatRepositoryImpl) Save(riwayat RiwayatModel) (*RiwayatModel, error) {
	result := ur.db.Save(&riwayat)

	if result.Error != nil {
		return nil, result.Error
	}

	return &riwayat, nil
}

func (ur *RiwayatRepositoryImpl) Update(riwayat RiwayatModel) (*RiwayatModel, error) {

	result := ur.db.Model(&riwayat).Updates(&riwayat)

	if result.Error != nil {

		return nil, result.Error
	}

	return &riwayat, nil
}

func (ur *RiwayatRepositoryImpl) Delete(riwayat RiwayatModel) (*RiwayatModel, error) {
	result := ur.db.Delete(&riwayat)

	if result.Error != nil {
		return nil, result.Error
	}

	return &riwayat, nil
}
