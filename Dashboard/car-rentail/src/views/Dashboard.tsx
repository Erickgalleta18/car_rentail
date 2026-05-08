// Dashboard.tsx  ← componente raíz
import { useState } from "react";
import "../dashboard.css";

import Sidebar from "../components/Sidebar";
import Topbar from "../components/Topbar";
import FiltersPanel from "../components/FiltersPanel";
import VehiclesPanel from "../components/VehiclesPanel";
import MapPanel from "../components/MapPanel";
import type Car from "../interfaces/Car"


const initialFavorites: Record<number, boolean> = { 1: false, 2: false, 3: true };

export default function Dashboard() {
  const [favorites, setFavorites] = useState<Record<number, boolean>>(initialFavorites);
  const [rentalType, setRentalType] = useState("any");
  const [availableOnly, setAvailableOnly] = useState(true);
  const [transmission, setTransmission] = useState("any");
  const [activeNav, setActiveNav] = useState("Vehicles");

  const toggleFav = (id: number) =>
    setFavorites((prev) => ({ ...prev, [id]: !prev[id] }));

  return (
    <div className="app-shell">
      {/* Columna izquierda: navegación principal */}
      <Sidebar activeNav={activeNav} onNavChange={setActiveNav} />

      {/* Área principal */}
      <div className="main-area">
        {/* Barra superior */}
        <Topbar />

        {/* Columnas de contenido */}
        <div className="content-row">
          {/* Panel de filtros */}
          <FiltersPanel
            rentalType={rentalType}
            onRentalTypeChange={setRentalType}
            availableOnly={availableOnly}
            onAvailableOnlyChange={setAvailableOnly}
            transmission={transmission}
            onTransmissionChange={setTransmission}
          />

          {/* Lista de vehículos */}
          <VehiclesPanel favorites={favorites} onToggleFav={toggleFav} />

          {/* Mapa */}
          <MapPanel />
        </div>
      </div>
    </div>
  );
}
