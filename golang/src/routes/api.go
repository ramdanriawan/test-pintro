package route

import (
	absensi "skyshi.com/src/entities/absensi"
	cuti "skyshi.com/src/entities/cuti"
	jabatan "skyshi.com/src/entities/jabatan"
	pegawai "skyshi.com/src/entities/pegawai"
	penggajian "skyshi.com/src/entities/penggajian"
	riwayat "skyshi.com/src/entities/riwayat"
	user "skyshi.com/src/entities/user"

	controllers "skyshi.com/src/controllers"

	"github.com/gin-gonic/gin"
	"gorm.io/gorm"
)

var (
	ctx *gin.Context
)

func Api(router *gin.Engine, db *gorm.DB, mw gin.HandlerFunc) {

	cutiRepository := cuti.NewCutiRepository(db)
	jabatanRepository := jabatan.NewJabatanRepository(db)
	userRepository := user.NewUserRepository(db)
	absensiRepository := absensi.NewAbsensiRepository(db)
	pegawaiRepository := pegawai.NewPegawaiRepository(db)
	riwayatRepository := riwayat.NewRiwayatRepository(db)
	penggajianRepository := penggajian.NewPenggajianRepository(db)

	cutiService := cuti.NewCutiService(cutiRepository)
	jabatanService := jabatan.NewJabatanService(jabatanRepository)
	pegawaiService := pegawai.NewPegawaiService(pegawaiRepository)
	userService := user.NewUserService(userRepository)
	absensiService := absensi.NewAbsensiService(absensiRepository)
	riwayatService := riwayat.NewRiwayatService(riwayatRepository)
	penggajianService := penggajian.NewPenggajianService(penggajianRepository)

	absensiController := controllers.NewAbsensiController(absensiService, ctx)
	userController := controllers.NewUserController(userService, ctx)
	cutiController := controllers.NewCutiController(cutiService, absensiService, ctx)
	jabatanController := controllers.NewJabatanController(jabatanService, absensiService, ctx)
	pegawaiController := controllers.NewPegawaiController(pegawaiService, absensiService, ctx)
	riwayatController := controllers.NewRiwayatController(riwayatService, absensiService, ctx)
	penggajianController := controllers.NewPenggajianController(penggajianService, absensiService, ctx)

	v1 := router.Group("/")
	{

		v1.POST("user/authenticate", mw, userController.Authenticate)
		v1.GET("user", mw, userController.Index)
		v1.POST("user", mw, userController.Create)
		v1.GET("user/:id", mw, userController.GetByID)
		v1.PATCH("user/:id", mw, userController.Update)
		v1.DELETE("user/:id", mw, userController.Delete)

		v1.GET("absensi", mw, absensiController.Index)
		v1.POST("absensi", mw, absensiController.Create)
		v1.GET("absensi/:id", mw, absensiController.GetByID)
		v1.PATCH("absensi/:id", mw, absensiController.Update)
		v1.DELETE("absensi/:id", mw, absensiController.Delete)

		v1.GET("/cuti", mw, cutiController.Index)
		v1.POST("/cuti", mw, cutiController.Create)
		v1.GET("/cuti/:id", mw, cutiController.GetByID)
		v1.PATCH("/cuti/:id", mw, cutiController.Update)
		v1.DELETE("/cuti/:id", mw, cutiController.Delete)

		v1.GET("/jabatan", mw, jabatanController.Index)
		v1.POST("/jabatan", mw, jabatanController.Create)
		v1.GET("/jabatan/:id", mw, jabatanController.GetByID)
		v1.PATCH("/jabatan/:id", mw, jabatanController.Update)
		v1.DELETE("/jabatan/:id", mw, jabatanController.Delete)

		v1.GET("/penggajian", mw, penggajianController.Index)
		v1.POST("/penggajian", mw, penggajianController.Create)
		v1.GET("/penggajian/:id", mw, penggajianController.GetByID)
		v1.PATCH("/penggajian/:id", mw, penggajianController.Update)
		v1.DELETE("/penggajian/:id", mw, penggajianController.Delete)

		v1.GET("/pegawai", mw, pegawaiController.Index)
		v1.POST("/pegawai", mw, pegawaiController.Create)
		v1.GET("/pegawai/:id", mw, pegawaiController.GetByID)
		v1.PATCH("/pegawai/:id", mw, pegawaiController.Update)
		v1.DELETE("/pegawai/:id", mw, pegawaiController.Delete)

		v1.GET("/riwayat", mw, riwayatController.Index)
		v1.POST("/riwayat", mw, riwayatController.Create)
		v1.GET("/riwayat/:id", mw, riwayatController.GetByID)
		v1.PATCH("/riwayat/:id", mw, riwayatController.Update)
		v1.DELETE("/riwayat/:id", mw, riwayatController.Delete)
	}
}
