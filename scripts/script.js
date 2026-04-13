const sidebar = document.getElementById("sidebar");

function toggleSidebar() {
  sidebar.classList.toggle("show");
}

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

const container = document.getElementById("grid-room-container");
const template = document.getElementById("room-template");

const colorMap = {
  occupied: "#e95f5f",
  vacant: "#8cc767",
  reserved: "#6c99ed",
  closed: "#878787",
};

const selectedRoomId = document.querySelector(
  'input[name="room-selection"]:checked',
)?.value;

if (selectedRoomId) {
  console.log("User selected room:", selectedRoomId);
} else {
  console.log("No room selected yet.");
}

function createRoomCard(room) {
  const clone = template.content.cloneNode(true);
  const wrapper = clone.querySelector(".room-wrapper");
  const card = clone.querySelector(".room-card");
  const input = clone.querySelector(".room-input");

  const uniqueId = `room-${room.id}`;
  input.id = uniqueId;
  card.setAttribute("for", uniqueId);
  input.value = room.id;

  clone.querySelector(".room-name").textContent = room.name;
  clone.querySelector(".room-status").textContent = room.status;

  const color = colorMap[room.status] || "#878787";
  card.style.setProperty("--status-color", color);

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

const roomsSched = [
  {
    id: 1,
    name: 2005,
    status: "occupied",
    slots: [
      { type: "occupied", label: "2ITA", time: "10:00 - 13:00" },
      { type: "vacant", label: "VACANT", time: "13:00 - 14:00" },
      { type: "reserved", label: "RESERVED", time: "14:00 - 17:00" },
    ],
  },
];

const app = document.getElementById("sidebar-view");

function createSideRoomCard(room) {
  const card = document.createElement("div");
  card.className = "room-list";

  card.innerHTML = `
    <div class="room-header">
      ${room.name}
      <span class="status-dot"></span>
    </div>
    <div class="room-status">Occupied</div>
  `;

  room.slots.forEach((slot) => {
    const slotDiv = document.createElement("div");
    slotDiv.className = "slot";

    slotDiv.innerHTML = `
      <div class="slot-header ${slot.type}">
        ${slot.label}
      </div>
      <div class="slot-time">
        ${slot.time}
      </div>
    `;

    card.appendChild(slotDiv);
  });

  return card;
}

roomsSched.forEach((room) => {
  app.appendChild(createSideRoomCard(room));
});
