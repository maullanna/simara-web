// Hover pada Menu Navigasi
let list = document.querySelectorAll(".navigation li");

function activeLink() {
  list.forEach((item) => {
    item.classList.remove("hovered");
  });
  this.classList.add("hovered");
}
list.forEach((item) => item.addEventListener("mouseover", activeLink));

// Toggle Menu Navigasi
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");
toggle.onclick = function () {
  navigation.classList.toggle("active");
  main.classList.toggle("active");
};

// Modal Tambah Data
const modal = document.getElementById("modal-popup");
const btnTambah = document.getElementById("btn-tambah");
const closeModal = document.querySelector(".close-modal");
const btnBatal = document.getElementById("btn-batal");
const btnSimpan = document.getElementById("btn-simpan");
const form = document.querySelector("form");
const inputs = form.querySelectorAll("input, textarea");

btnTambah.onclick = function () {
  modal.style.display = "flex";
};

// Fungsi untuk menutup modal tambah
function closeModalTambah() {
  modal.style.display = "none";
  form.reset(); // Reset form setiap kali modal ditutup
}

// Event listener untuk tombol close dan batal
closeModal.onclick = closeModalTambah;
btnBatal.onclick = closeModalTambah;

// Fungsi validasi input
function validateInputs() {
  let isValid = true;

  inputs.forEach((input) => {
    if (input.value.trim() === "") {
      isValid = false;
    }
  });

  btnSimpan.disabled = !isValid;
  btnSimpan.classList.toggle("disabled", !isValid);
}

// Validasi input saat ada perubahan
inputs.forEach((input) => {
  input.addEventListener("input", validateInputs);
});

// Simpan Data
form.onsubmit = function (event) {
  event.preventDefault();
  if (!btnSimpan.disabled) {
    alert("Data berhasil disimpan!"); // Placeholder untuk aksi simpan
    closeModalTambah();
  }
};

// Drag-and-Drop Upload Gambar
const input1 = document.getElementById("input1");
const fileInput = document.getElementById("file-input");
const uploadBtn = document.getElementById("button-foto");
const preview = document.getElementById("preview");
const dropHint = document.getElementById("drop-hint");
const fileNameDisplay = document.getElementById("file-name");

input1.addEventListener("dragover", (e) => {
  e.preventDefault();
  input1.classList.add("dragging");
  dropHint.style.display = "block";
});

input1.addEventListener("dragleave", () => {
  input1.classList.remove("dragging");
  dropHint.style.display = "none";
});

input1.addEventListener("drop", (e) => {
  e.preventDefault();
  input1.classList.remove("dragging");
  dropHint.style.display = "none";
  handleFile(e.dataTransfer.files[0]);
});

uploadBtn.addEventListener("click", () => fileInput.click());

fileInput.addEventListener("change", (e) => {
  handleFile(e.target.files[0]);
});

function handleFile(file) {
  const maxSizeMB = 1;

  if (file) {
    if (file.size > maxSizeMB * 1024 * 1024) {
      alert("File hanya boleh berukuran maksimal 1 MB.");
      return;
    }
    if (file.type.startsWith("image/")) {
      const reader = new FileReader();
      reader.onload = (e) => {
        preview.src = e.target.result;
        preview.style.display = "block";
        fileNameDisplay.textContent = file.name;
        fileNameDisplay.style.display = "block";
      };
      reader.readAsDataURL(file);
    } else {
      alert("Silahkan upload file dengan format gambar.");
    }
  }
}

// Modal Konfirmasi Hapus
const modalKonfirmasi = document.getElementById("modal-konfirmasi");
const btnBatalHapus = document.getElementById("btn-batal-hapus");
const btnHapus = document.getElementById("btn-hapus");
const deleteIcons = document.querySelectorAll(".icon-delete");

deleteIcons.forEach((icon) => {
  icon.addEventListener("click", () => {
    modalKonfirmasi.style.display = "flex";
  });
});

btnBatalHapus.onclick = function () {
  modalKonfirmasi.style.display = "none";
};

btnHapus.onclick = function () {
  alert("Data berhasil dihapus!"); // Placeholder untuk aksi hapus
  modalKonfirmasi.style.display = "none";
};
