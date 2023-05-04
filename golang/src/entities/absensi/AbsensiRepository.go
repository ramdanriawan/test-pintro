package absensi

import (
	"gorm.io/gorm"
)

type AbsensiRepository interface {
	FindAll() []AbsensiModel
	FindOne(id int) AbsensiModel
	FindByEmailAndPassword(email string, password string) AbsensiModel
	Save(absensi AbsensiModel) (*AbsensiModel, error)
	Update(absensi AbsensiModel) (*AbsensiModel, error)
	Delete(absensi AbsensiModel) (*AbsensiModel, error)
}

type AbsensiRepositoryImpl struct {
	db *gorm.DB
}

func NewAbsensiRepository(db *gorm.DB) AbsensiRepository {
	return &AbsensiRepositoryImpl{db}
}

func (ur *AbsensiRepositoryImpl) FindAll() []AbsensiModel {
	var absensis []AbsensiModel

	_ = ur.db.Preload("Orders.OrderDetails.Cuti").Find(&absensis)

	return absensis

}

func (ur *AbsensiRepositoryImpl) FindOne(id int) AbsensiModel {
	var absensi AbsensiModel
	_ = ur.db.Preload("Orders.OrderDetails.Cuti").Find(&absensi, id)

	return absensi
}

func (ur *AbsensiRepositoryImpl) FindByEmailAndPassword(email string, password string) AbsensiModel {
	var absensi AbsensiModel
	_ = ur.db.Where("email", email).Where("password", password).Find(&absensi)

	return absensi
}

func (ur *AbsensiRepositoryImpl) Save(absensi AbsensiModel) (*AbsensiModel, error) {
	result := ur.db.Save(&absensi)

	if result.Error != nil {
		return nil, result.Error
	}

	return &absensi, nil
}

func (ur *AbsensiRepositoryImpl) Update(absensi AbsensiModel) (*AbsensiModel, error) {
	result := ur.db.Model(&absensi).Updates(&absensi)

	if result.Error != nil {
		return nil, result.Error
	}

	return &absensi, nil
}

func (ur *AbsensiRepositoryImpl) Delete(absensi AbsensiModel) (*AbsensiModel, error) {
	result := ur.db.Preload("Orders.OrderDetails.Cuti").Delete(&absensi)

	if result.Error != nil {
		return nil, result.Error
	}

	return &absensi, nil
}
