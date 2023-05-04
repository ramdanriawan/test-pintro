package penggajian

import (
	"gorm.io/gorm"
)

type PenggajianRepository interface {
	FindAll() []PenggajianModel
	FindOne(id int64) PenggajianModel
	Save(penggajian PenggajianModel) (*PenggajianModel, error)
	Update(penggajian PenggajianModel) (*PenggajianModel, error)
	Delete(penggajian PenggajianModel) (*PenggajianModel, error)
}

type PenggajianRepositoryImpl struct {
	db *gorm.DB
}

func NewPenggajianRepository(db *gorm.DB) PenggajianRepository {
	return &PenggajianRepositoryImpl{db}
}

func (ur *PenggajianRepositoryImpl) FindAll() []PenggajianModel {
	var penggajians []PenggajianModel

	_ = ur.db.Find(&penggajians)

	return penggajians

}

func (ur *PenggajianRepositoryImpl) FindOne(id int64) PenggajianModel {
	var penggajian PenggajianModel
	_ = ur.db.Find(&penggajian, id)

	return penggajian
}

func (ur *PenggajianRepositoryImpl) Save(penggajian PenggajianModel) (*PenggajianModel, error) {
	result := ur.db.Save(&penggajian)

	if result.Error != nil {
		return nil, result.Error
	}

	return &penggajian, nil
}

func (ur *PenggajianRepositoryImpl) Update(penggajian PenggajianModel) (*PenggajianModel, error) {

	result := ur.db.Model(&penggajian).Updates(&penggajian)

	if result.Error != nil {

		return nil, result.Error
	}

	return &penggajian, nil
}

func (ur *PenggajianRepositoryImpl) Delete(penggajian PenggajianModel) (*PenggajianModel, error) {
	result := ur.db.Delete(&penggajian)

	if result.Error != nil {
		return nil, result.Error
	}

	return &penggajian, nil
}
