const sidebar = document.getElementById("sidebar");

function toggleSidebar() {
  sidebar.classList.toggle("show");
}

const status = ["occupied", "vacant", "reserved", "closed"];

const rooms = [
  { id: 1, name: 2001, status: "occupied" },
  { id: 2, name: 2002, status: "vacant" },
  { id: 3, name: 2003, status: "occupied" },
  { id: 4, name: 2004, status: "reserved" },
  { id: 5, name: 2005, status: "occupied" },
  { id: 6, name: 2006, status: "occupied" },
  { id: 7, name: 2007, status: "occupied" },
  { id: 8, name: 2008, status: "closed" },
  { id: 9, name: 2009, status: "occupied" },
  { id: 10, name: 2010, status: "occupied" },
  { id: 11, name: 2011, status: "occupied" },
  { id: 12, name: 2012, status: "vacant" },
  { id: 13, name: 2013, status: "vacant" },
  { id: 14, name: 2014, status: "reserved" },
  { id: 15, name: 2015, status: "occupied" },
];

const container = document.getElementById("room-grid-container");
const template = document.getElementById("room-template");

const colorMap = {
  occupied: "#e95f5f",
  vacant: "#8cc767",
  reserved: "#6c99ed",
  closed: "#878787",
};

function createRoomCard(room) {
  const clone = template.content.cloneNode(true);

  // We MUST target the div with the class, not the fragment itself
  const card = clone.querySelector(".room-card");

  clone.querySelector(".room-name").textContent = room.name;
  clone.querySelector(".room-status").textContent = room.status;

  // 1. Correct syntax: No "var()" wrapper here
  // 2. Correct name: Must match the CSS exactly
  const color = colorMap[room.status] || "#878787";
  card.style.setProperty("--status-color", color);

  card.dataset.id = room.id;
  return clone;
}

rooms.forEach((room) => {
  container.appendChild(createRoomCard(room));
});

function updateRoomStatus(id, newStatus) {
  const card = document.querySelector(`.room-card[data-id="${id}"]`);

  if (card) {
    const statusEl = card.querySelector(".room-status");
    if (statusEl) statusEl.textContent = newStatus;

    const newColor = colorMap[newStatus] || "#878787";
    card.style.setProperty("--status-color", newColor);

    card.style.transform = "scale(1.02)";
    setTimeout(() => (card.style.transform = "scale(1)"), 200);
  }
}
