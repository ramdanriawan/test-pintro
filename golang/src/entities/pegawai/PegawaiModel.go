package pegawai

// "gorm.io/gorm"

type PegawaiModel struct {
	ID            int    `gorm:"AUTO_INCREMENT"`
	Nama          string `json:"nama" gorm:"type:varchar(50)"`
	TanggalLahir  string `json:"tanggal_lahir" gorm:"type:varchar(100)"`
	TempatLahir   string `json:"tempat_lahir" gorm:"type:varchar(100)"`
	JenisKelamin  string `json:"jenis_kelamin" gorm:"type:varchar(100)"`
	Agama         string `json:"agama" gorm:"type:varchar(100)"`
	Alamat        string `json:"alamat" gorm:"type:varchar(100)"`
	NoTelp        string `json:"no_telp" gorm:"type:varchar(100)"`
	TglMulaiKerja string `json:"tgl_mulai_kerja" gorm:"type:varchar(100)"`
	Status        string `json:"status" gorm:"type:varchar(100)"`
}

func (PegawaiModel) TableName() string {
	return "pegawai"
}
