package cuti

import (
	"gorm.io/gorm"
)

type CutiRepository interface {
	FindAll() []CutiModel
	FindOne(id int64) CutiModel
	Save(cuti CutiModel) (*CutiModel, error)
	Update(cuti CutiModel) (*CutiModel, error)
	Delete(cuti CutiModel) (*CutiModel, error)
}

type CutiRepositoryImpl struct {
	db *gorm.DB
}

func NewCutiRepository(db *gorm.DB) CutiRepository {
	return &CutiRepositoryImpl{db}
}

func (ur *CutiRepositoryImpl) FindAll() []CutiModel {
	var cutis []CutiModel

	_ = ur.db.Find(&cutis)

	return cutis

}

func (ur *CutiRepositoryImpl) FindOne(id int64) CutiModel {
	var cuti CutiModel
	_ = ur.db.Find(&cuti, id)

	return cuti
}

func (ur *CutiRepositoryImpl) Save(cuti CutiModel) (*CutiModel, error) {
	result := ur.db.Save(&cuti)

	if result.Error != nil {
		return nil, result.Error
	}

	return &cuti, nil
}

func (ur *CutiRepositoryImpl) Update(cuti CutiModel) (*CutiModel, error) {

	result := ur.db.Model(&cuti).Updates(&cuti)

	if result.Error != nil {

		return nil, result.Error
	}

	return &cuti, nil
}

func (ur *CutiRepositoryImpl) Delete(cuti CutiModel) (*CutiModel, error) {
	result := ur.db.Delete(&cuti)

	if result.Error != nil {
		return nil, result.Error
	}

	return &cuti, nil
}
