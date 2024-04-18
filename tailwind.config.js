/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.php",
    "./data_barang.php",
    "./data_transaksi.php",
    "./tambah_barang.pshp",
    "./update_barang.php",
    "./update_transaksi.php",
    "./kasir.php",
    "./login.php",
    "./registrasi.php",
    "./nota.php",
    "./print.php",
  ],
  theme: {
    extend: {
      fontFamily: {
        abel: ["Abel"],
        quicksand: ["Quicksand"],
      },
      colors: {
        ungu: ["#8C52FF"],
        putih: ["#F4F4F4"],
        hero: ["#27384C"],
      },
      animation: {
        "spin-slow": "spin 10s linear infinite",
        "spin-slow-2": "spin 12s linear infinite",
        "bounce-slow": "bounce 3s infinite;",
      },
    },
  },
  plugins: [],
};
