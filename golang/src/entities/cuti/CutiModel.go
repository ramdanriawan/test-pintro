package cuti

// "gorm.io/gorm"

type CutiModel struct {
	ID              int    `gorm:"AUTO_INCREMENT"`
	PegawaiId       string `json:"pegawai_id" gorm:"type:bigInt(20)"`
	NomorPermohonan string `json:"nomor_permohonan" gorm:"type:bigInt(20)"`
	TanggalMulai    string `json:"tanggal_mulai" gorm:"type:varchar(100)"`
	TanggalSelesai  string `json:"tanggal_selesai" gorm:"type:varchar(100)"`
	Keterangan      string `json:"keterangan" gorm:"type:varchar(100)"`
}

func (CutiModel) TableName() string {
	return "cuti"
}
