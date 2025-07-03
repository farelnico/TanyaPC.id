/*  public/js/location.js
    Ganti peta & alamat saat dropdown berubah (tanpa API-key)  */
document.addEventListener('DOMContentLoaded', () => {
  const select   = document.getElementById('branchSelect');
  const frame    = document.getElementById('mapFrame');
  const address  = document.querySelector('#branchDetail address');

  // data cabang diambil dari atribut data-*
  const branches = JSON.parse(select.dataset.branches);

  select.addEventListener('change', () => {
    const data = branches[select.value];
    frame.src  = data.embed;        // ganti iframe
    address.textContent = data.address; // ganti alamat
  });
});
