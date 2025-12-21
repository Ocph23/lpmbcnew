// document.addEventListener("DOMContentLoaded", function () {
//     const documents = [
//         {no:1, name:"Laporan SPMI Tahunan", desc:"Dokumen laporan pelaksanaan Sistem Penjaminan Mutu Internal", link:"#"},
//         {no:2, name:"Dokumen Standar Mutu", desc:"Dokumen standar operasional dan akademik di seluruh unit kerja", link:"#"},
//         {no:3, name:"Laporan Audit Mutu Internal (AMI)", desc:"Hasil audit dan rekomendasi perbaikan mutu", link:"#"},
//         {no:4, name:"Laporan Akreditasi Program Studi", desc:"Dokumen hasil penilaian akreditasi BAN-PT", link:"#"},
//         {no:5, name:"Data Penelitian dan Pengabdian Masyarakat", desc:"Data aktivitas akademik yang mendukung mutu universitas", link:"#"},
//         {no:6, name:"Dokumen SOP Akademik", desc:"Standard Operating Procedure untuk kegiatan akademik", link:"#"},
//         {no:7, name:"Laporan Kinerja Dosen", desc:"Data evaluasi kinerja dosen tiap semester", link:"#"},
//         {no:8, name:"Rencana Kerja Tahunan", desc:"Dokumen perencanaan tahunan LPM", link:"#"},
//         {no:9, name:"Formulir Evaluasi Mahasiswa", desc:"Formulir penilaian mahasiswa untuk evaluasi internal", link:"#"},
//         {no:10, name:"Dokumen Kebijakan Mutu", desc:"Kebijakan umum penjaminan mutu universitas", link:"#"},
//         {no:11, name:"Laporan Penelitian Mahasiswa", desc:"Dokumen hasil penelitian mahasiswa", link:"#"},
//         {no:12, name:"Dokumen Panduan Akreditasi", desc:"Panduan persiapan akreditasi program studi", link:"#"}
//     ];

//     const rowsPerPage = 5;
//     let currentPage = 1;

//     function displayTable(page) {
//         const tableBody = document.querySelector("#dataTable tbody");
//         tableBody.innerHTML = "";

//         const start = (page - 1) * rowsPerPage;
//         const end = start + rowsPerPage;
//         const pageData = documents.slice(start, end);

//         pageData.forEach(doc => {
//             const row = document.createElement("tr");
//             row.innerHTML = `
//                 <td>${doc.no}</td>
//                 <td>${doc.name}</td>
//                 <td>${doc.desc}</td>
//                 <td><a href="${doc.link}">Download</a></td>
//             `;
//             tableBody.appendChild(row);
//         });

//         setupPagination();
//     }

//     function setupPagination() {
//         const pagination = document.getElementById("pagination");
//         pagination.innerHTML = "";
//         const pageCount = Math.ceil(documents.length / rowsPerPage);

//         for (let i = 1; i <= pageCount; i++) {
//             const btn = document.createElement("button");
//             btn.innerText = i;
//             if (i === currentPage) btn.classList.add("active");
//             btn.addEventListener("click", function () {
//                 currentPage = i;
//                 displayTable(currentPage);
//             });
//             pagination.appendChild(btn);
//         }
//     }

//     displayTable(currentPage);
// });
