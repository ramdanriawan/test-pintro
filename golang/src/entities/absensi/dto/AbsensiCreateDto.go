package absensi

type AbsensiCreateDto struct {
	Id       int    `json:"id"`
	PegawaiId     string `json:"pegawai_id" validate:"required,max=100,min=1"`
	Tanggal     string `json:"tanggal" validate:"required,max=100,min=1"`
	JamMasuk    string `json:"jam_masuk" validate:"required"`
	JamKeluar    string `json:"jam_keluar" validate:"required"`
}
