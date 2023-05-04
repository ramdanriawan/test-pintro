package pegawai

type PegawaiUpdateDto struct {
	ID        int    `json:"id"`
	Nama          string `json:"nama"  validate:"required"`
	TanggalLahir  string `json:"tanggal_lahir"`
	TempatLahir   string `json:"tempat_lahir"`
	JenisKelamin  string `json:"jenis_kelamin"`
	Agama         string `json:"agama"`
	Alamat        string `json:"alamat"`
	NoTelp        string `json:"no_telp"`
	TglMulaiKerja string `json:"tgl_mulai_kerja"`
	Status        string `json:"status"`
}
