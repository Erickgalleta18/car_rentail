// components/MapPanel.tsx

export default function MapPanel() {
  return (
    <div className="map-panel">
      <div className="map-bg" />

      {/* Streets SVG */}
      <svg
        className="map-streets"
        viewBox="0 0 800 700"
        preserveAspectRatio="xMidYMid slice"
      >
        <path d="M 0 200 Q 200 180 400 220 T 800 200" stroke="white" strokeWidth="18" fill="none" opacity="0.9" />
        <path d="M 0 400 Q 300 380 500 420 T 800 400" stroke="white" strokeWidth="14" fill="none" opacity="0.9" />
        <path d="M 200 0 Q 220 200 200 400 T 220 700" stroke="white" strokeWidth="10" fill="none" opacity="0.9" />
        <path d="M 500 0 Q 520 200 500 400 T 520 700" stroke="white" strokeWidth="18" fill="none" opacity="0.9" />
        <path d="M 0 600 L 800 580" stroke="white" strokeWidth="8" fill="none" opacity="0.7" />
        <path d="M 350 0 L 370 700" stroke="white" strokeWidth="8" fill="none" opacity="0.7" />
        {/* Route dashes */}
        <path
          d="M 130 520 L 200 460 L 280 470 L 370 360 L 460 370 L 520 230 L 640 260 L 700 200"
          stroke="#0f0f0f"
          strokeWidth="3.5"
          fill="none"
          strokeLinejoin="round"
          strokeLinecap="round"
          strokeDasharray="8 4"
          opacity="0.7"
        />
      </svg>

      {/* Search bar */}
      <div className="map-search">
        <span style={{ fontSize: 14, color: "#aaa" }}>🔍</span>
        <input placeholder="Search address or vehicles..." />
      </div>

      {/* Top-right controls */}
      <div className="map-controls-right">
        <button className="map-btn">⛶</button>
      </div>

      {/* Zoom controls */}
      <div className="map-zoom">
        <button>+</button>
        <button>−</button>
      </div>

      {/* Location button */}
      <button className="location-btn">◎</button>

      {/* Walk time badge */}
      <div className="walk-badge" style={{ top: "52%", right: "12%" }}>
        🚶 15 min
      </div>

      {/* Route endpoint dots */}
      <div
        className="route-dot"
        style={{ width: 12, height: 12, background: "#4caf50", top: 510, left: 122 }}
      />
      <div
        className="route-dot"
        style={{ width: 16, height: 16, background: "#0f0f0f", top: 192, left: 692 }}
      />

      {/* Map pins */}
      <div className="map-pin" style={{ top: "22%", left: "18%" }}>
        <span>2</span>
      </div>
      <div className="map-pin" style={{ top: "66%", left: "30%" }}>
        <span>3</span>
      </div>
      <div className="map-pin" style={{ bottom: "12%", right: "22%" }}>
        <span>5</span>
      </div>
      <div className="map-pin accent" style={{ top: "18%", right: "12%" }}>
        <span>6</span>
      </div>

      {/* Popup card */}
      <div className="map-popup">
        <div className="popup-top">
          <span className="popup-rating">
            <span className="stars">★</span> 4.9{" "}
            <span style={{ color: "#aaa", fontWeight: 400 }}>(189)</span>
          </span>
          <button className="popup-fav-sm">🤍</button>
        </div>
        <img
          src="https://images.unsplash.com/photo-1541899481282-d53bffe3c35d?auto=format&fit=crop&q=80&w=400"
          alt="VW Golf GTI"
          className="popup-img"
        />
        <div className="popup-name">VW Golf GTI</div>
        <div className="popup-spec">2.0 TSI Autobahn (241 hp, FWD)</div>
        <button className="popup-book-btn">
          <span>Book</span>
          <span>$20/h</span>
        </button>
        <div className="popup-arrow" />
      </div>
    </div>
  );
}
