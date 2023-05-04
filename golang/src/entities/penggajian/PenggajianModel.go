package penggajian

// "gorm.io/gorm"

type PenggajianModel struct {
	ID        int    `gorm:"AUTO_INCREMENT"`
	PegawaiId string `json:"pegawai_id" gorm:"type:bigInt(20)"`
	Gaji      string `json:"gaji" gorm:"type:bigInt(20)"`
	Tunjangan string `json:"tunjangan" gorm:"type:bigInt(20)"`
	Bonus     string `json:"bonus" gorm:"type:bigInt(20)"`
	Periode   string `json:"periode" gorm:"type:varchar(100)"`
	Tahun     string `json:"tahun" gorm:"type:varchar(100)"`
	Tanggal   string `json:"tanggal" gorm:"type:varchar(100)"`
	Catatan   string `json:"catatan" gorm:"type:varchar(100)"`
}

func (PenggajianModel) TableName() string {
	return "penggajian"
}
