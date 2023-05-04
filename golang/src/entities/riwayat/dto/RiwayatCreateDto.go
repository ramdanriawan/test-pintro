package riwayat

type RiwayatCreateDto struct {
	ID               int    `json:"id"`
	PegawaiId        string `json:"pegawai_id"  validate:"required"`
	NamaJabatan      string `json:"nama_jabatan"`
	GajiJabatan      string `json:"gaji_jabatan"`
	TunjanganJabatan string `json:"tunjangan_jabatan"`
	BonusJabatan     string `json:"bonus_jabatan"`
	NomorSk          string `json:"nomor_sk"`
	Tanggal          string `json:"tanggal"`
	Status           string `json:"status"`
}
