// components/MapPanel.tsx
import Map from "react-map-gl/mapbox";
import "mapbox-gl/dist/mapbox-gl.css"


export default function MapPanel() {
    const initialState = {
      longitude:-107.878650,
      latitude:30.380583,
      zoom:14
    }

    const mapToken = import.meta.env.VITE_MAPBOX

  return (
    <>
    
    <Map
      mapboxAccessToken={mapToken}
      initialViewState={initialState}
      mapStyle="mapbox://styles/mapbox/streets-v9"
    />
    
    </>
  );
}
