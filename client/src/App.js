import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Routes, Route } from 'react-router-dom';
import { Container } from 'react-bootstrap';

import LoginForm from './Components/Login/Login';
import RegisterForm from './Components/Register/Register';
import Header from './Components/Header/Header';
import AuthRequire from './Components/Auth/AuthRequire';
import Layout from './Components/Layout/Layout';
import Footer from './Components/Footer/Footer';
import Horaire from './Components/Footer/Horaire';

function App() {
  return (

    <div className=" bg-dark text-light min-vh-100 d-flex flex-column App">
      <Container fluid className="header">
        <Header />
      </Container>

      <Container className='content'>
        <Routes>

          <Route path='/' element={<Layout />}>
            <Route path="/login" element={<LoginForm />} />
          </Route  >

          <Route element={<AuthRequire role="Admin" />}>
            <Route path="/register" element={<RegisterForm />} />
          </Route>

        </Routes>


      </Container>
      <Container fluid className="footer">
        <Horaire />
      </Container>
    </div>
  );
}

export default App;
