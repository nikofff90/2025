
async function cekKelulusan() {
    const nis = document.getElementById('nis').value.trim();
    const nama = document.getElementById('nama').value.trim().toUpperCase();
    const hasil = document.getElementById('hasil');

    try {
        const response = await fetch('data_siswa.json');
        const data = await response.json();

        if (data[nis] && data[nis] === nama) {
            hasil.innerText = "Selamat! Anda dinyatakan LULUS.";
            hasil.style.color = "lightgreen";
        } else {
            hasil.innerText = "Data tidak ditemukan atau tidak cocok.";
            hasil.style.color = "red";
        }
    } catch (error) {
        hasil.innerText = "Gagal memuat data.";
        hasil.style.color = "red";
    }
}
