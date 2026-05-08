import { Route, BrowserRouter, Routes } from 'react-router-dom'
import Dashboard from './views/Dashboard'
import Contact from './views/Contact'


function App() {
  
  return (
    <>
      <BrowserRouter>
        <Routes>
          <Route path="/" element={<Dashboard />} />
          <Route path="/Contact" element={<Contact />} />
        </Routes>
      </BrowserRouter>
    </>
  )
}

export default App
