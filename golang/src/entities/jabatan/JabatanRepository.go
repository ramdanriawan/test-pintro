package jabatan

import (
	"gorm.io/gorm"
)

type JabatanRepository interface {
	FindAll() []JabatanModel
	FindOne(id int64) JabatanModel
	Save(jabatan JabatanModel) (*JabatanModel, error)
	Update(jabatan JabatanModel) (*JabatanModel, error)
	Delete(jabatan JabatanModel) (*JabatanModel, error)
}

type JabatanRepositoryImpl struct {
	db *gorm.DB
}

func NewJabatanRepository(db *gorm.DB) JabatanRepository {
	return &JabatanRepositoryImpl{db}
}

func (ur *JabatanRepositoryImpl) FindAll() []JabatanModel {
	var jabatans []JabatanModel

	_ = ur.db.Find(&jabatans)

	return jabatans

}

func (ur *JabatanRepositoryImpl) FindOne(id int64) JabatanModel {
	var jabatan JabatanModel
	_ = ur.db.Find(&jabatan, id)

	return jabatan
}

func (ur *JabatanRepositoryImpl) Save(jabatan JabatanModel) (*JabatanModel, error) {
	result := ur.db.Save(&jabatan)

	if result.Error != nil {
		return nil, result.Error
	}

	return &jabatan, nil
}

func (ur *JabatanRepositoryImpl) Update(jabatan JabatanModel) (*JabatanModel, error) {

	result := ur.db.Model(&jabatan).Updates(&jabatan)

	if result.Error != nil {

		return nil, result.Error
	}

	return &jabatan, nil
}

func (ur *JabatanRepositoryImpl) Delete(jabatan JabatanModel) (*JabatanModel, error) {
	result := ur.db.Delete(&jabatan)

	if result.Error != nil {
		return nil, result.Error
	}

	return &jabatan, nil
}
