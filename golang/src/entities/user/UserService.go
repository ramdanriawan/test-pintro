package user

import (
	"fmt"
	"log"
	"strconv"

	"golang.org/x/crypto/bcrypt"
	dto "skyshi.com/src/entities/user/dto"

	"github.com/gin-gonic/gin"
	"github.com/go-playground/validator/v10"
)

type UserService interface {
	GetAll() []UserModel
	GetByID(id int) UserModel
	GetByEmailAndPassword(email string, password string) UserModel
	Create(ctx *gin.Context) (*UserModel, error)
	Update(ctx *gin.Context) (*UserModel, error)
	Delete(ctx *gin.Context) (*UserModel, error)
}

type UserServiceImpl struct {
	userRepository UserRepository
}

func NewUserService(ordertransactionRepository UserRepository) UserService {
	return &UserServiceImpl{ordertransactionRepository}
}

func hashPassword(password string) (hashedPassword string) {

	hash, err := bcrypt.GenerateFromPassword([]byte(password), bcrypt.DefaultCost)
	if err != nil {
		log.Fatal(err)
	}
	fmt.Println("Hashed password", string(hash))

	return string(hash)

}

func checkPassword(hashedPassword string, password string) (isPasswordValid bool) {

	if err := bcrypt.CompareHashAndPassword([]byte(hashedPassword), []byte(password)); err != nil {
		return false
	}

	return true
}

func (us *UserServiceImpl) GetAll() []UserModel {
	return us.userRepository.FindAll()
}

func (us *UserServiceImpl) GetByID(id int) UserModel {
	return us.userRepository.FindOne(id)
}

func (us *UserServiceImpl) GetByEmailAndPassword(email string, password string) UserModel {
	return us.userRepository.FindByEmailAndPassword(email, password)
}

func (us *UserServiceImpl) Create(ctx *gin.Context) (*UserModel, error) {
	var input dto.UserCreateDto

	if err := ctx.ShouldBindJSON(&input); err != nil {
		return nil, err
	}

	validate := validator.New()

	err := validate.Struct(input)

	if err != nil {
		return nil, err
	}

	user := UserModel{
		Email:    input.Email,
		Name:     input.Name,
		Password: hashPassword(input.Password),
	}

	result, err := us.userRepository.Save(user)

	if err != nil {
		return nil, err
	}

	return result, nil
}

func (us *UserServiceImpl) Update(ctx *gin.Context) (*UserModel, error) {
	id, _ := strconv.Atoi(ctx.Param("id"))

	var input dto.UserUpdateDto

	if err := ctx.ShouldBindJSON(&input); err != nil {
		return nil, err
	}

	validate := validator.New()

	err := validate.Struct(input)

	if err != nil {
		return nil, err
	}

	user := UserModel{
		ID:       int(id),
		Name:     input.Name,
		Email:    input.Email,
		Password: hashPassword(input.Password),
	}

	if string(input.Password) == "" {
		user = UserModel{
			ID:    int(id),
			Name:  input.Name,
			Email: input.Email,
		}
	}

	result, err := us.userRepository.Update(user)

	if err != nil {
		return nil, err
	}

	return result, nil
}

func (us *UserServiceImpl) Delete(ctx *gin.Context) (*UserModel, error) {
	id, _ := strconv.Atoi(ctx.Param("id"))

	ordertransaction := UserModel{
		ID: int(id),
	}

	result, err := us.userRepository.Delete(ordertransaction)

	if err != nil {
		return nil, err
	}

	return result, nil
}
