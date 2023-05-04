package penggajian

type PenggajianUpdateDto struct {
	ID        int    `json:"id"`
	PegawaiId string `json:"pegawai_id"  validate:"required"`
	Gaji      string `json:"gaji"`
	Tunjangan string `json:"tunjangan"`
	Bonus     string `json:"bonus"`
	Periode   string `json:"periode"`
	Tahun     string `json:"tahun"`
	Tanggal   string `json:"tanggal"`
	Catatan   string `json:"catatan"`
}
