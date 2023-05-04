package user

import (
	"fmt"
	"log"

	"golang.org/x/crypto/bcrypt"
	"gorm.io/gorm"
)

type UserRepository interface {
	FindAll() []UserModel
	FindOne(id int) UserModel
	FindByEmailAndPassword(email string, password string) UserModel
	Save(user UserModel) (*UserModel, error)
	Update(user UserModel) (*UserModel, error)
	Delete(user UserModel) (*UserModel, error)
}

type UserRepositoryImpl struct {
	db *gorm.DB
}

func NewUserRepository(db *gorm.DB) UserRepository {
	return &UserRepositoryImpl{db}
}

func hashPassword2(password string) (hashedPassword string) {

	hash, err := bcrypt.GenerateFromPassword([]byte(password), bcrypt.DefaultCost)
	if err != nil {
		log.Fatal(err)
	}
	fmt.Println("Hashed password", string(hash))

	return string(hash)

}

func checkPassword2(hashedPassword string, password string) (isPasswordValid bool) {

	if err := bcrypt.CompareHashAndPassword([]byte(hashedPassword), []byte(password)); err != nil {
		return false
	}

	return true
}

func (ur *UserRepositoryImpl) FindAll() []UserModel {
	var users []UserModel

	_ = ur.db.Preload("Orders.OrderDetails.Cuti").Find(&users)

	return users

}

func (ur *UserRepositoryImpl) FindOne(id int) UserModel {
	var user UserModel
	_ = ur.db.Preload("Orders.OrderDetails.Cuti").Find(&user, id)

	return user
}

func (ur *UserRepositoryImpl) FindByEmailAndPassword(email string, password string) UserModel {
	var user UserModel
	_ = ur.db.Where("email", email).Find(&user)

	if checkPassword(user.Password, password) {
		return user
	}

	return UserModel{}
}

func (ur *UserRepositoryImpl) Save(user UserModel) (*UserModel, error) {
	result := ur.db.Save(&user)

	if result.Error != nil {
		return nil, result.Error
	}

	return &user, nil
}

func (ur *UserRepositoryImpl) Update(user UserModel) (*UserModel, error) {
	result := ur.db.Model(&user).Updates(&user)

	if result.Error != nil {
		return nil, result.Error
	}

	return &user, nil
}

func (ur *UserRepositoryImpl) Delete(user UserModel) (*UserModel, error) {
	result := ur.db.Preload("Orders.OrderDetails.Cuti").Delete(&user)

	if result.Error != nil {
		return nil, result.Error
	}

	return &user, nil
}
