package cuti

type CutiCreateDto struct {
	ID              int    `json:"id"`
	PegawaiId       string `json:"pegawai_id" validate:"required"`
	NomorPermohonan string    `json:"nomor_permohonan"  validate:"required"`
	TanggalMulai    string `json:"tanggal_mulai"`
	TanggalSelesai  string `json:"tanggal_selesai"`
	Keterangan      string `json:"keterangan"`
}
