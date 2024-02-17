import {Navigate, Outlet, useLocation} from "react-router-dom"
import AuthUse from "./AuthUse"

const AuthRequire = ({role}) => {
    const { auth } = AuthUse();
    const location = useLocation();

    if(!auth.role) {
        return <Navigate to="/login" state={{from : location}} replace />
    }
    if (!role.includes(auth.role)) {
         return <Navigate to="/unauthorized" state={{ from: location }} replace />;
    }
    return <Outlet />
}

export default AuthRequire