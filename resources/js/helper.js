const helper = {
    downloadOptions: [
        { kode: 'dasarhukum', kategori: 'Dasar Humum' },
        { kode: 'skpendirian', kategori: 'Sk Pendirian/Izin Prodi, Institusi ' },
        { kode: 'pedoman', kategori: 'Pedoman' },
        { kode: 'template', kategori: 'Template' },
        { kode: 'skrektor', kategori: 'SK Rektor' },
        { kode: 'spmidanami', kategori: 'SPMI & AMI' },
        { kode: 'panduankurikulum', kategori: 'Panduan Kurikulum' },
    ],


    kategoriOptions: [
        { kode: 'spmi', kategori: 'Kebijakan SPMI', unit: false },
        { kode: 'spmi', kategori: 'Manual Mutu', unit: false },
        { kode: 'spmi', kategori: 'Standar SPMI', unit: false },
        { kode: 'spmi', kategori: 'Prosedur Mutu', unit: false },
        { kode: 'spme', kategori: 'Borang Akreditasi', unit: false },
        { kode: 'spme', kategori: 'Hasil Akreditasi', unit: false },
        { kode: 'spme', kategori: 'Tindak Lanjut Akreditasi', unit: false },
        { kode: 'spmi', kategori: 'Formulir SPMI', unit: true },
        { kode: 'spmi', kategori: 'Prosedur Kerja', unit: true },
        { kode: 'spmi', kategori: 'Standar UPPS|Unit', unit: true },
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
