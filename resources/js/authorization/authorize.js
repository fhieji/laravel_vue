import policies from './policies'
import { type } from 'jquery';

export default{
    install (Vue, option) {
        Vue.prototype.authorize = function (policy, model) {
            if (! window.Auth.signedIn) return false;
        
            if (typeof policy === 'string' && typeof model === 'object') {
                const user = window.Auth.user;
        
                return policies[policy](user, model);
                //authorize ('modify, answer)
            }
        };

        Vue.prototype.signedIn = window.Auth.signedIn
    }
}

