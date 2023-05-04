package absensi

import (
	"gorm.io/gorm"
)

type AbsensiModel struct {
	ID       int    `gorm:"AUTO_INCREMENT"`
	PegawaiId     string `json:"pegawai_id" gorm:"type:bigInt(20)"`
	Tanggal     string `json:"tanggal" gorm:"type:varchar(100)"`
	JamMasuk    string `json:"jam_masuk" gorm:"type:varchar(100)"`
	JamKeluar    string `json:"jam_keluar" gorm:"type:varchar(100)"`

	gorm.Model
}

func (AbsensiModel) TableName() string {
	return "absensi"
}
