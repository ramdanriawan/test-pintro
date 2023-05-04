package user

import (
	"gorm.io/gorm"
)

type UserModel struct {
	ID       int    `gorm:"AUTO_INCREMENT"`
	Name     string `json:"name" gorm:"type:varchar(100)"`
	Email    string `json:"email" gorm:"type:varchar(100)"`
	Password string `json:"password" gorm:"type:varchar(100)"`

	gorm.Model
}

func (UserModel) TableName() string {
	return "user"
}
