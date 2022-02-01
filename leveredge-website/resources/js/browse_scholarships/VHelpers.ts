import * as R from 'rambdax'
import { VueConstructor, PluginFunction } from 'vue'

export const VHelpers = {
	install: function (Vue) {
		if (VHelpers['installed']) {
			return
		}
		VHelpers['installed'] = true
		Vue.prototype.$_ = require('lodash')
		Vue.prototype.$dayjs = require('dayjs')
		Vue.prototype.$R = require('rambdax')
		Vue.prototype.$log = (...args) => console.log(`$log ->`, ...R.clone(args))
		Vue.prototype.$development = process?.env?.NODE_ENV == 'development'
	} as PluginFunction<never>,
}

export default VHelpers

declare module 'vue/types/vue' {
	interface VueConstructor {
		prototype: Vue
	}
	interface Vue {
		$_: typeof import('lodash')
		$dayjs: typeof import('dayjs')
		$R: typeof import('rambdax')
		$log: typeof console.log
		$development: boolean
	}
}
