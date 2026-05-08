// components/FiltersPanel.tsx

const bodyTypes = [
  { id: "sedan", label: "Sedan", checked: true },
  { id: "wagon", label: "Wagon", checked: false },
  { id: "coupe", label: "Coupe", checked: true },
  { id: "hatchback", label: "Hatchback", checked: true },
  { id: "pickup", label: "Pickup", checked: false },
  { id: "sport", label: "Sport coupe", checked: false },
  { id: "crossover", label: "Crossover", checked: true },
  { id: "van", label: "Van", checked: true },
];

const fuelTypes = [
  { id: "gas", label: "Gasoline", checked: true },
  { id: "flex", label: "Flex Fuel (E85)", checked: true },
  { id: "diesel", label: "Diesel", checked: false },
  { id: "hybrid", label: "Hybrid", checked: false },
  { id: "electric", label: "Electric", checked: true },
  { id: "hydrogen", label: "Hydrogen", checked: false },
  { id: "other", label: "Other", checked: false },
];

const priceBarHeights = [20, 30, 40, 50, 60, 80, 100, 90, 70, 50, 40, 30, 20, 25, 35, 45];

interface FiltersPanelProps {
  rentalType: string;
  onRentalTypeChange: (type: string) => void;
  availableOnly: boolean;
  onAvailableOnlyChange: (value: boolean) => void;
  transmission: string;
  onTransmissionChange: (type: string) => void;
}

export default function FiltersPanel({
  rentalType,
  onRentalTypeChange,
  availableOnly,
  onAvailableOnlyChange,
  transmission,
  onTransmissionChange,
}: FiltersPanelProps) {
  return (
    <aside className="filters-panel">
      {/* Header */}
      <div className="filter-header">
        <span className="filter-title">Filter by</span>
        <button className="reset-btn">Reset all ✕</button>
      </div>

      {/* Rental type */}
      <div className="filter-section">
        <span className="filter-label">Rental Type</span>
        <div className="pill-group">
          {["any", "per-day", "per-hour"].map((t) => (
            <button
              key={t}
              className={`pill ${rentalType === t ? "active" : ""}`}
              onClick={() => onRentalTypeChange(t)}
            >
              {t === "any" ? "Any" : t === "per-day" ? "Per day" : "Per hour"}
            </button>
          ))}
        </div>
      </div>

      {/* Available now */}
      <div className="toggle-row">
        <span className="toggle-label">Available Now Only</span>
        <label className="toggle-switch">
          <input
            type="checkbox"
            checked={availableOnly}
            onChange={() => onAvailableOnlyChange(!availableOnly)}
          />
          <span className="toggle-slider" />
        </label>
      </div>

      {/* Price range */}
      <div className="filter-section">
        <div className="collapsible-row">
          <span className="filter-label" style={{ marginBottom: 0 }}>Price Range / Hour</span>
          <span style={{ fontSize: 10, color: "#aaa" }}>▲</span>
        </div>
        <div className="price-bars">
          {priceBarHeights.map((h, i) => (
            <div
              key={i}
              className={`bar ${i >= 4 && i <= 12 ? "active" : ""}`}
              style={{ height: `${h}%` }}
            />
          ))}
        </div>
        <div className="price-range-track">
          <div className="price-range-fill" />
          <div className="range-thumb" style={{ left: "25%" }} />
          <div className="range-thumb" style={{ left: "75%" }} />
        </div>
        <div className="price-inputs">
          <div className="price-box">
            <div className="price-box-label">FROM</div>
            <div className="price-box-val">$19.00</div>
          </div>
          <div className="price-box">
            <div className="price-box-label">TO</div>
            <div className="price-box-val">$98.50</div>
          </div>
        </div>
      </div>

      <div className="filter-divider" />

      {/* Car Brand (collapsed) */}
      <div className="collapsible-row">
        <span className="filter-label" style={{ marginBottom: 0 }}>Car Brand</span>
        <span style={{ fontSize: 10, color: "#aaa" }}>▼</span>
      </div>
      <div className="filter-divider" />

      {/* Car Model & Year (collapsed) */}
      <div className="collapsible-row">
        <span className="filter-label" style={{ marginBottom: 0 }}>Car Model & Year</span>
        <span style={{ fontSize: 10, color: "#aaa" }}>▼</span>
      </div>
      <div className="filter-divider" />

      {/* Body type */}
      <div className="filter-section">
        <div className="collapsible-row">
          <span className="filter-label" style={{ marginBottom: 0 }}>Body Type</span>
          <span style={{ fontSize: 10, color: "#aaa" }}>▲</span>
        </div>
        <div className="checkbox-grid">
          {bodyTypes.map((item) => (
            <label key={item.id} className="check-item">
              <input type="checkbox" defaultChecked={item.checked} />
              {item.label}
            </label>
          ))}
        </div>
      </div>

      <div className="filter-divider" />

      {/* Transmission */}
      <div className="filter-section">
        <div className="collapsible-row">
          <span className="filter-label" style={{ marginBottom: 0 }}>Transmission</span>
          <span style={{ fontSize: 10, color: "#aaa" }}>▲</span>
        </div>
        <div className="pill-group">
          {["any", "automatic", "manual"].map((t) => (
            <button
              key={t}
              className={`pill ${transmission === t ? "active" : ""}`}
              onClick={() => onTransmissionChange(t)}
            >
              {t.charAt(0).toUpperCase() + t.slice(1)}
            </button>
          ))}
        </div>
      </div>

      <div className="filter-divider" />

      {/* Fuel type */}
      <div className="filter-section">
        <div className="collapsible-row">
          <span className="filter-label" style={{ marginBottom: 0 }}>Fuel Type</span>
          <span style={{ fontSize: 10, color: "#aaa" }}>▲</span>
        </div>
        <div className="checkbox-grid">
          {fuelTypes.map((item) => (
            <label key={item.id} className="check-item">
              <input type="checkbox" defaultChecked={item.checked} />
              {item.label}
            </label>
          ))}
        </div>
      </div>
    </aside>
  );
}
