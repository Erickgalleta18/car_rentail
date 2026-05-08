// components/Topbar.tsx

export default function Topbar() {
  return (
    <header className="topbar">
      <div className="topbar-meta">
        <span>🕐 01:48 PM (UTC -7)</span>
        <span>📍 San Francisco, US</span>
      </div>
      <div className="topbar-right">
        <button className="pro-badge">
          <span className="crown">♛</span> PRO features
        </button>
        <img
          src="https://i.pravatar.cc/150?img=11"
          alt="User"
          className="avatar"
        />
      </div>
    </header>
  );
}
