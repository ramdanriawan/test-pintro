package jabatan

type JabatanCreateDto struct {
	ID        int    `json:"id"`
	Nama      string `json:"nama"  validate:"required"`
	Gaji      string `json:"gaji"`
	Tunjangan string `json:"tunjangan"`
	Bonus     string `json:"bonus"`
}
