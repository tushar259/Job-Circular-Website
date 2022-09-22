import Home from './components/Home';
import AboutUs from './components/AboutUs';
import NotFound from './components/NotFound';
import DeleteCircular from './components/DeleteCircular';
import EditCircular from './components/EditCircular';
import ViewCircular from './components/ViewCircular';
import ViewCircularList from './components/ViewCircularList';
import SignUp from './components/SignUp';
import SignIn from './components/SignIn';
import UserProfile from './components/UserProfile';
import EditUserProfile from './components/EditUserProfile';
import CompanyProfile from './components/CompanyProfile';
import EditCompanyProfile from './components/EditCompanyProfile';
import SignOut from './components/SignOut';
import ChangeUserPassword from './components/ChangeUserPassword';
import ChangeCompanyPassword from './components/ChangeCompanyPassword';
import Users from './components/UserList';
import SearchResults from './components/SearchResults';
import PayBy from './components/PayBy';
import PayByBkash from './components/PayByBkash';
import PayByRocket from './components/PayByRocket';
import PayByNagad from './components/PayByNagad';
import PaymentHistory from './components/PaymentHistory';
import ChangePassword from './components/ChangePassword';
import AboutUser from './components/AboutUser';
import AboutCompany from './components/AboutCompany';



export default{
    mode: 'history',
    linkActiveClass: 'font-semibold',

    routes: [
        {
            path: '*',
            component: NotFound
        },
        {
            path: '/',
            component: Home
        },
        {
            path: '/about-us',
            component: AboutUs
        },
        {
            path: '/delete-circular/:givencircid',
            component: DeleteCircular
        },
        {
            path: '/edit-circular/:givencircid',
            component: EditCircular
        },
        {
            path: '/view-circular/:givencircid',
            component: ViewCircular
        },
        {
            path: '/circular-list',
            component: ViewCircularList
        },
        {
            path: '/sign-in',
            component: SignIn
        },
        {
            path: '/sign-up',
            component: SignUp
        },
        {
            path: '/profile/:givencircid/0a3i-15k04cn27=l103rt83-25jkx4',
            component: UserProfile
        },
        {
            path: '/edit-profile/0a3i-15k04cn27=l103rt83-25jkx4',
            component: EditUserProfile
        },
        {
            path: '/profile/:givencircid/0a5ci=159t04cn27-l3jsvm3rt83-y6',
            component: CompanyProfile
        },
        {
            path: '/edit-profile/0a5ci=159t04cn27-l3jsvm3rt83-y6',
            component: EditCompanyProfile
        },
        {
            path: '/sign-out',
            component: SignOut
        },
        {
            path: '/change-password/0a3i-15k04cn27=l103rt83-25jkx4',
            component: ChangeUserPassword
        },
        {
            path: '/change-password/0a5ci=159t04cn27-l3jsvm3rt83-y6',
            component: ChangeCompanyPassword
        },
        {
            path: '/user-company-profiles',
            component: Users
        },
        {
            path: '/search',
            component: SearchResults
        },
        {
            path: '/pay-method',
            component: PayBy
        },
        {
            path: '/pay-method-bkash',
            component: PayByBkash
        },
        {
            path: '/pay-method-rocket',
            component: PayByRocket
        },
        {
            path: '/pay-method-nagad',
            component: PayByNagad
        },
        {
            path: '/payment-history',
            component: PaymentHistory
        },
        {
            path: '/change-password',
            component: ChangePassword
        },
        {
            path: '/about-me/:givencircid/0a3i-15k04cn27=l103rt83-25jkx4',
            component: AboutUser
        },
        {
            path: '/about-company/:givencircid/0a5ci=159t04cn27-l3jsvm3rt83-y6',
            component: AboutCompany
        },
    ]
}