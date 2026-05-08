// components/Sidebar.tsx

const navItems = [
  { icon: "🏠", label: "Home" },
  { icon: "🚗", label: "Vehicles" },
  { icon: "📝", label: "Notes" },
  { icon: "♡", label: "Favourites" },
  { icon: "🕐", label: "Recents" },
];

const navBottom = [
  { icon: "🔔", label: "Notifications" },
  { icon: "💬", label: "Chat" },
];

const navFooter = [
  { icon: "🪪", label: "License" },
  { icon: "❓", label: "Support" },
  { icon: "→", label: "Logout" },
];

interface SidebarProps {
  activeNav: string;
  onNavChange: (label: string) => void;
}

export default function Sidebar({ activeNav, onNavChange }: SidebarProps) {
  return (
    <aside className="sidebar">
      <div>
        {/* Logo */}
        <div className="logo-wrap">
          <div className="logo-icon-box">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="#0f0f0f" />
              <path
                d="M2 17L12 22L22 17M2 12L12 17L22 12"
                stroke="#0f0f0f"
                strokeWidth="2"
                strokeLinecap="round"
                strokeLinejoin="round"
              />
            </svg>
          </div>
          <span className="logo-text">CAR<br />RENTAIL</span>
        </div>

        {/* Primary nav */}
        <nav className="nav-group">
          {navItems.map((item) => (
            <button
              key={item.label}
              className={`nav-item ${activeNav === item.label ? "active" : ""}`}
              onClick={() => onNavChange(item.label)}
            >
              <span className="nav-icon">{item.icon}</span>
              {item.label}
              {activeNav === item.label && <span className="nav-dot" />}
            </button>
          ))}
          <div className="nav-divider" />
          {navBottom.map((item) => (
            <button key={item.label} className="nav-item">
              <span className="nav-icon">{item.icon}</span>
              {item.label}
            </button>
          ))}
        </nav>
      </div>

      {/* Footer nav */}
      <nav className="nav-group">
        {navFooter.map((item) => (
          <button key={item.label} className="nav-item">
            <span className="nav-icon">{item.icon}</span>
            {item.label}
          </button>
        ))}
      </nav>
    </aside>
  );
}
