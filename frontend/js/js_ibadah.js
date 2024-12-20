//menambahkankan hover pada klik menu
let list = document.querySelectorAll(".navigation li");

function activeLink() {
  list.forEach((item) => {
    item.classList.remove("hovered");
  });
  this.classList.add("hovered");
}
list.forEach((item) => item.addEventListener("mouseover", activeLink));
// menu toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");
toggle.onclick = function () {
  navigation.classList.toggle("active");
  main.classList.toggle("active");
};
/// Get elements
const modal = document.getElementById("modal-popup");
const btnTambah = document.getElementById("btn-tambah");
const closeModal = document.querySelector(".close-modal");
const btnBatal = document.getElementById("btn-batal");
const btnSimpan = document.getElementById("btn-simpan");
const form = document.querySelector("form");
const inputs = form.querySelectorAll("input");
const btnDelete = document.getElementById("btn-delete");

// Fungsi untuk mengecek apakah semua input sudah diisi
function checkInputs() {
  let allFilled = true;

  inputs.forEach((input) => {
    if (input.value.trim() === "") {
      allFilled = false;
    }
  });

  // Jika semua input terisi, enable tombol Simpan dan Batal
  if (allFilled) {
    btnSimpan.classList.remove("disabled");
    btnBatal.classList.remove("disabled");
    btnSimpan.disabled = false;
    btnBatal.disabled = false;
  } else {
    btnSimpan.classList.add("disabled");
    btnBatal.classList.add("disabled");
    btnSimpan.disabled = true;
    btnBatal.disabled = true;
  }
}
modal.style.display = "none";

btnTambah.onclick = function () {
  modal.style.display = "flex";
  checkInputs();
};

function closeModalTambah() {
  modal.style.display = "none";
}

// Tambahkan event listener untuk tombol "Close" dan "Batal"
if (closeModal) {
  closeModal.onclick = closeModalTambah;
}
if (btnBatal) {
  btnBatal.onclick = closeModalTambah;
}

// Cek setiap kali ada perubahan pada input
inputs.forEach((input) => {
  input.addEventListener("input", checkInputs);
});

// Ketika tombol "Simpan" diklik, modal juga bisa ditutup setelah submit (opsional)
form.onsubmit = function (event) {
  event.preventDefault(); // Anda bisa menghapus ini jika ingin form benar-benar submit
  if (!btnSimpan.classList.contains("disabled")) {
    modal.style.display = "none";
  }
};

// Ambil elemen modal dan tombol
const modalKonfirmasi = document.getElementById("modal-konfirmasi");
const closeModalKonfirmasi = document.querySelector(".close-modal-konfirmasi");
const btnBatalHapus = document.getElementById("btn-batal-hapus");
const btnHapus = document.getElementById("btn-hapus");

// Fungsi untuk menampilkan modal
function showConfirmationModal() {
  modalKonfirmasi.style.display = "flex";
}

// Fungsi untuk menutup modal
function closeConfirmationModal() {
  modalKonfirmasi.style.display = "none";
}

// Tambahkan event listener ke setiap ikon hapus
const deleteIcons = document.querySelectorAll(".icon-delete");
deleteIcons.forEach((icon) => {
  icon.addEventListener("click", showConfirmationModal);
});

// Tambahkan event listener untuk tombol "X" dan "Batal"
if (closeModalKonfirmasi) {
  closeModalKonfirmasi.onclick = closeConfirmationModal;
}
if (btnBatalHapus) {
  btnBatalHapus.onclick = closeConfirmationModal;
}

// Fungsi untuk tombol hapus (tambahkan logika hapus sesuai kebutuhan)
if (btnHapus) {
  btnHapus.onclick = function () {
    console.log("Item deleted!"); // Placeholder untuk logika hapus
    closeConfirmationModal(); // Tutup modal setelah menghapus
  };
}
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
  const file = e.dataTransfer.files[0];
  handleFile(file);
});

uploadBtn.addEventListener("click", () => fileInput.click());

fileInput.addEventListener("change", (e) => {
  const file = e.target.files[0];
  handleFile(file);
});

function handleFile(file) {
  const maxSizeMB = 1;
  if (file) {
    if (file.size > maxSizeMB * 1024 * 1024) {
      alert("File hanya boleh berukuran maksimal 1 Mb.");
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
      alert("Silahkan Upload Foto Disini.");
    }
  }
}

//file uji coba
