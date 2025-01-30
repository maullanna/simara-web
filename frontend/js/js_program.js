// =====================================
// Navigation Menu Hover Functionality
// =====================================
let list = document.querySelectorAll(".navigation li");

function activeLink() {
  list.forEach((item) => item.classList.remove("hovered"));
  this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("click", activeLink));

// =====================================
// Menu Toggle Functionality
// =====================================
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
  navigation.classList.toggle("active");
  main.classList.toggle("active");
};

// =====================================
// Modal for Adding Programs
// =====================================
const modal = document.getElementById("modal-popup");
const btnTambah = document.getElementById("btn-tambah");
const closeModal = document.querySelector(".close-modal");
const btnBatal = document.getElementById("btn-batal");
const btnSimpan = document.getElementById("btn-simpan");
const form = document.querySelector("form");
const inputs = form.querySelectorAll("input, textarea");

// Hide modal initially
modal.style.display = "none";

// Show modal on "Tambah" button click
btnTambah.onclick = function () {
  modal.style.display = "flex";
  checkInputs(); // Check inputs when modal opens
};

// Close modal function
function closeModalTambah() {
  modal.style.display = "none";
}

// Add event listeners for "Close" and "Batal" buttons
if (closeModal) closeModal.onclick = closeModalTambah;
if (btnBatal) btnBatal.onclick = closeModalTambah;

// Function to check if all inputs are filled
function checkInputs() {
  let allFilled = true;
  inputs.forEach((input) => {
    if (input.value.trim() === "") {
      allFilled = false;
    }
  });

  // Enable/disable "Simpan" and "Batal" buttons
  btnSimpan.disabled = !allFilled;
  btnBatal.disabled = !allFilled;
  if (allFilled) {
    btnSimpan.classList.remove("disabled");
    btnBatal.classList.remove("disabled");
  } else {
    btnSimpan.classList.add("disabled");
    btnBatal.classList.add("disabled");
  }
}

// Check inputs on every change
inputs.forEach((input) => input.addEventListener("input", checkInputs));

// On form submit (optional: prevent default)
form.onsubmit = function (event) {
  event.preventDefault(); // Prevent form submission if needed
  if (!btnSimpan.classList.contains("disabled")) {
    modal.style.display = "none";
    console.log("Form submitted successfully!"); // Debugging
  }
};

// =====================================
// Modal for Delete Confirmation
// =====================================
const modalKonfirmasi = document.getElementById("modal-konfirmasi");
const closeModalKonfirmasi = document.querySelector(".close-modal-konfirmasi");
const btnBatalHapus = document.getElementById("btn-batal-hapus");
const btnHapus = document.getElementById("btn-hapus");

// Show modal confirmation
function showConfirmationModal() {
  modalKonfirmasi.style.display = "flex";
}

// Close modal confirmation
function closeConfirmationModal() {
  modalKonfirmasi.style.display = "none";
}

// Add event listeners to delete icons
const deleteIcons = document.querySelectorAll(".icon-delete");
deleteIcons.forEach((icon) => {
  icon.addEventListener("click", showConfirmationModal);
});

// Add event listeners for "Close" and "Batal" buttons in confirmation modal
if (closeModalKonfirmasi) closeModalKonfirmasi.onclick = closeConfirmationModal;
if (btnBatalHapus) btnBatalHapus.onclick = closeConfirmationModal;

// Handle delete action
if (btnHapus) {
  btnHapus.onclick = function () {
    console.log("Item deleted!"); // Add delete logic here
    closeConfirmationModal(); // Close modal after deleting
  };
}

// =====================================
// Drag-and-Drop File Upload
// =====================================
const input1 = document.getElementById("input1");
const fileInput = document.getElementById("file-input");
const uploadBtn = document.getElementById("button-foto");
const dropHint = document.getElementById("drop-hint");
const fileListDisplay = document.getElementById("file-list");
let files = [];

// Handle drag over
input1.addEventListener("dragover", (e) => {
  e.preventDefault();
  input1.classList.add("dragging");
  dropHint.style.display = "block";
});

// Handle drag leave
input1.addEventListener("dragleave", () => {
  input1.classList.remove("dragging");
  dropHint.style.display = "none";
});

// Handle drop files
input1.addEventListener("drop", (e) => {
  e.preventDefault();
  input1.classList.remove("dragging");
  dropHint.style.display = "none";
  const droppedFiles = Array.from(e.dataTransfer.files);
  handleFiles(droppedFiles);
});

// Handle file input click
uploadBtn.addEventListener("click", () => fileInput.click());

// Handle file input change
fileInput.addEventListener("change", (e) => {
  const selectedFiles = Array.from(e.target.files);
  handleFiles(selectedFiles);
});

// Function to process files
function handleFiles(selectedFiles) {
  const maxSizeMB = 5; // Total max size in MB
  const currentSize = files.reduce((total, file) => total + file.size, 0);

  if (currentSize + selectedFiles.reduce((total, file) => total + file.size, 0) > maxSizeMB * 1024 * 1024) {
    alert("Total ukuran file tidak boleh lebih dari 5 MB.");
    return;
  }

  selectedFiles.forEach((file) => {
    if (files.length < 5) {
      if (file.type.startsWith("image/")) {
        files.push(file);
        displayFile(file);
      } else {
        alert("Silahkan Upload Foto Disini.");
      }
    } else {
      alert("Anda hanya dapat mengupload maksimal 5 foto.");
    }
  });
}

// Function to display file in the list
function displayFile(file) {
  const fileItem = document.createElement("div");

  // Create file name and size
  const fileSize = (file.size / 1024).toFixed(2) + " KB"; // Convert size to KB
  fileItem.textContent = `${file.name} (${fileSize})`;

  // Style adjustments
  fileItem.style.textAlign = "right";
  fileItem.style.display = "flex";
  fileItem.style.justifyContent = "space-between";

  const closeIcon = document.createElement("span");
  closeIcon.innerHTML = "&#10006;"; // 'x' icon
  closeIcon.style.cursor = "pointer";
  closeIcon.style.marginLeft = "10px";

  // Remove file on close icon click
  closeIcon.onclick = () => {
    files = files.filter((f) => f !== file);
    fileListDisplay.removeChild(fileItem);
  };

  fileItem.appendChild(closeIcon);
  fileListDisplay.appendChild(fileItem);
}
