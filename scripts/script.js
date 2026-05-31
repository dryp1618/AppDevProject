const sidebar = document.getElementById("sidebar");
function toggleSidebar() {
  sidebar.classList.toggle("show");
}

const container = document.getElementById("grid-room-container");
const template = document.getElementById("room-template");

container.addEventListener("click", function (e) {
  if (!e.target.closest(".room-wrapper")) {
    const checked = document.querySelector(
      'input[name="room-selection"]:checked',
    );
    if (checked) {
      checked.checked = false;
      checked.dataset.wasChecked = "false";
      clearSidebar();
    }
  }
});

const colorMap = {
  1: "#e95f5f", //occupied
  2: "#8cc767", //vacant
  3: "#6c99ed", //reserved
  4: "#878787", //closed
};

function clearSidebar() {
  app.innerHTML = `<hr class="line">
  <div class="no-room-selected">NO ROOM SELECTED</div>
  <hr class="line">`;
}

function createRoomCard(room) {
  const clone = template.content.cloneNode(true);
  const wrapper = clone.querySelector(".room-wrapper");
  const card = clone.querySelector(".room-card");
  const input = clone.querySelector(".room-input");

  const statusMap = {
    1: "Occupied",
    2: "Available",
    3: "Reserved",
    4: "Closed",
  };

  const uniqueId = `${room.id}`;
  input.id = uniqueId;
  card.setAttribute("for", uniqueId);
  input.value = room.id;

  clone.querySelector(".room-name").textContent = room.name;
  clone.querySelector(".room-status").textContent =
    statusMap[room.status] ?? "Unknown";

  const color = colorMap[room.status] || "#878787";
  card.style.setProperty("--status-color", color);

  input.addEventListener("click", function () {
    if (this.dataset.wasChecked === "true") {
      this.checked = false;
      this.dataset.wasChecked = "false";
      clearSidebar();
    } else {
      document
        .querySelectorAll('input[name="room-selection"]')
        .forEach((i) => (i.dataset.wasChecked = "false"));
      this.dataset.wasChecked = "true";
      fetchRoomData(this.value);
    }
  });

  return clone;
}

function groupByFloor(rooms) {
  return rooms.reduce((acc, room) => {
    const floor = Math.floor(room.name / 100);
    if (!acc[floor]) acc[floor] = [];
    acc[floor].push(room);
    return acc;
  }, {});
}

function renderRooms(rooms) {
  const grouped = groupByFloor(rooms);

  const sortedFloors = Object.keys(grouped).sort((a, b) => b - a);

  sortedFloors.forEach((floor) => {
    const section = document.createElement("div");
    section.className = "floor-section";
    section.dataset.floor = floor;

    const label = document.createElement("h2");
    label.className = "floor-label";
    label.textContent = `${floor}th Floor`;

    const grid = document.createElement("div");
    grid.className = "floor-grid";

    grouped[floor].forEach((room) => {
      grid.appendChild(createRoomCard(room));
    });

    section.appendChild(label);
    section.appendChild(grid);
    container.appendChild(section);
  });
}

renderRooms(rooms);

// ===========================================================================

//  ==============================================================

function getSelectedRoomId() {
  return (
    document.querySelector('input[name="room-selection"]:checked')?.value ??
    null
  );
}

// const roomsSched = [
//   {
//     id: 1,
//     name: 2005,
//     status: "occupied",
//     slots: [
//       { type: "occupied", label: "2ITA", time: "10:00 - 13:00" },
//       { type: "vacant", label: "VACANT", time: "13:00 - 14:00" },
//       { type: "reserved", label: "RESERVED", time: "14:00 - 17:00" },
//     ],
//   },
// ];

function fetchRoomData(roomId) {
  $.ajax({
    url: "../controllers/scheduleController.php",
    type: "POST",
    data: { reqRoomDetail: roomId },
    dataType: "json",
    success: function (data) {
      console.log("raw data:", data);
      console.log("slots:", data.slots);
      const roomSched = {
        ...data,
        slots: buildSlotsWithVacant(data.slots),
      };
      app.innerHTML = "";
      app.appendChild(createSideRoomCard(roomSched));
    },
    error: function (xhr, status, err) {
      console.error("Request failed: ", status, err);
    },
  });
}

function buildSlotsWithVacant(slots) {
  if (!slots.length) return [];

  const result = [];

  for (let i = 0; i < slots.length; i++) {
    result.push(slots[i]);

    // Check gap between current end and next start
    if (i < slots.length - 1) {
      const currEnd = slots[i].time.split(" - ")[1];
      const nextStart = slots[i + 1].time.split(" - ")[0];

      if (currEnd !== nextStart) {
        result.push({
          type: "vacant",
          label: "VACANT",
          time: `${currEnd} - ${nextStart}`,
        });
      }
    }
  }

  return result;
}

document.querySelectorAll('input[name="room-selection"]').forEach((radio) => {
  radio.addEventListener("change", () => {
    document.getElementById("sidebar").classList.remove("invis");
  });
});

const app = document.getElementById("sidebar-view");

function createSideRoomCard(room) {
  const card = document.createElement("div");
  card.className = "room-list";

  const statusKey = getCurrentStatus(room.slots);
  const dotColor = colorMap[statusKey];

  card.innerHTML = `
    <div class="room-header">
      ${room.name}
      <span class="status-dot" style="background-color: ${dotColor}"></span>
    </div>
    <div class="room-status">${statusKey === 1 ? "Occupied" : "Vacant"}</div>
  `;
  if (!room.slots || room.slots.length === 0) {
    const empty = document.createElement("div");
    empty.textContent = "No upcoming schedules.";
    card.appendChild(empty);
    return card;
  }

  room.slots.forEach((slot) => {
    const slotDiv = document.createElement("div");
    slotDiv.className = "slot";
    slotDiv.innerHTML = `
      <div class="slot-header ${slot.type}">${slot.label}</div>
      <div class="slot-time">${slot.time}</div>
    `;
    card.appendChild(slotDiv);
  });

  return card;
}

function getCurrentStatus(slots) {
  const now = new Date();
  const currMinutes = now.getHours() * 60 + now.getMinutes();

  for (const slot of slots) {
    if (slot.type === "vacant") continue;

    const [startStr, endStr] = slot.time.split(" - ");
    const [sh, sm] = startStr.split(":").map(Number);
    const [eh, em] = endStr.split(":").map(Number);
    const startMinutes = sh * 60 + sm;
    const endMinutes = eh * 60 + em;

    if (currMinutes >= startMinutes && currMinutes <= endMinutes) {
      return 1; // occupied
    }
  }
  return 2; // vacant
}
