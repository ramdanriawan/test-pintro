package riwayat

// "gorm.io/gorm"

type RiwayatModel struct {
	ID               int    `gorm:"AUTO_INCREMENT"`
	PegawaiId        string `json:"pegawai_id" gorm:"type:bigInt(20)"`
	NamaJabatan      string `json:"nama_jabatan" gorm:"type:bigInt(20)"`
	GajiJabatan      string `json:"gaji_jabatan" gorm:"type:bigInt(20)"`
	TunjanganJabatan string `json:"tunjangan_jabatan" gorm:"type:bigInt(20)"`
	BonusJabatan     string `json:"bonus_jabatan" gorm:"type:varchar(100)"`
	NomorSk          string `json:"nomor_sk" gorm:"type:varchar(100)"`
	Tanggal          string `json:"tanggal" gorm:"type:varchar(100)"`
	Status           string `json:"status" gorm:"type:varchar(100)"`
}

func (RiwayatModel) TableName() string {
	return "riwayat_jabatan"
}
