const helper = {
    downloadOptions: [
        { kode: 'dasarhukum', kategori: 'Dasar Hukum' },
        { kode: 'skpendirian', kategori: 'Sk Pendirian/Izin Prodi, Institusi ' },
        { kode: 'pedoman', kategori: 'Pedoman' },
        { kode: 'template', kategori: 'Template' },
        { kode: 'skrektor', kategori: 'SK Rektor' },
        { kode: 'spmidanami', kategori: 'SPMI & AMI' },
        { kode: 'panduankurikulum', kategori: 'Panduan Kurikulum' },
    ],
    kategoriOptions: [
        { kode: 'spmi', kategori: 'kebijakan_spmi', title: 'Kebijakan SPMI', unit: false },
        { kode: 'spmi', kategori: 'manual_mutu', title: 'Manual Mutu', unit: false },
        { kode: 'spmi', kategori: 'standar_spmi', title: 'Standar SPMI', unit: false },
        { kode: 'spmi', kategori: 'prosedur_mutu', title: 'Prosedur Mutu', unit: false },
        { kode: 'spme', kategori: 'borang_akreditasi', title: 'Borang Akreditasi', unit: false },
        { kode: 'spme', kategori: 'hasil_akreditasi', title: 'Hasil Akreditasi', unit: false },
        { kode: 'spme', kategori: 'tindaklanjut_akreditasi', title: 'Tindaklanjut Akreditasi', unit: false },
        { kode: 'spmi', kategori: 'formulir_spmi', title: 'Formulir SPMI', unit: true },
        { kode: 'spmi', kategori: 'prosedur_kerja', title: 'Prosedur Kerja', unit: true },
        { kode: 'spmi', kategori: 'standar_upps_unit', title: 'Standar UPPS|Unit', unit: true },
    ],
    formatDate: (isoString) => {
        if (!isoString) return '–';
        const date = new Date(isoString);
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();
        return `${day}/${month}/${year}`;
    }
}


export default helper;
