package jabatan

// "gorm.io/gorm"

type JabatanModel struct {
	ID        int    `gorm:"AUTO_INCREMENT"`
	Nama      string `json:"nama" gorm:"type:bigInt(20)"`
	Gaji      string `json:"gaji" gorm:"type:varchar(100)"`
	Tunjangan string `json:"tunjangan" gorm:"type:varchar(100)"`
	Bonus     string `json:"bonus" gorm:"type:varchar(100)"`
}

func (JabatanModel) TableName() string {
	return "jabatan"
}
