import React, { Fragment, useState } from 'react';
import PropTypes from 'prop-types';
import { Dialog, Transition } from '@headlessui/react'
import {
    BrowserRouter,
    Routes,
    Route, Link,
} from "react-router-dom";
import Farms from './Farms';
import Farm from './Farm';
import Turbines from './Turbines';
import Turbine from './Turbine';
import { FolderIcon, HomeIcon, MenuIcon, UsersIcon, XIcon } from '@heroicons/react/outline';
import NavLink from './NavLink';
import Inspections from './Inspections';
import Inspection from './Inspection';

function classNames(...classes) {
    return classes.filter(Boolean).join(' ')
}

const navigation = [
    { name: 'Wind Farms', href: '/farms', icon: HomeIcon },
    { name: 'Turbines', href: '/turbines', icon: UsersIcon },
    { name: 'Inspections', href: '/inspections', icon: FolderIcon },
]

const App = () => {
    const [sidebarOpen, setSidebarOpen] = useState(false)

    return (
        <BrowserRouter>

            <>
                <div>
                    <Transition.Root show={sidebarOpen} as={Fragment}>
                        <Dialog as="div" className="fixed inset-0 flex z-40 md:hidden" onClose={setSidebarOpen}>
                            <Transition.Child
                                as={Fragment}
                                enter="transition-opacity ease-linear duration-300"
                                enterFrom="opacity-0"
                                enterTo="opacity-100"
                                leave="transition-opacity ease-linear duration-300"
                                leaveFrom="opacity-100"
                                leaveTo="opacity-0"
                            >
                                <Dialog.Overlay className="fixed inset-0 bg-gray-600 bg-opacity-75" />
                            </Transition.Child>
                            <Transition.Child
                                as={Fragment}
                                enter="transition ease-in-out duration-300 transform"
                                enterFrom="-translate-x-full"
                                enterTo="translate-x-0"
                                leave="transition ease-in-out duration-300 transform"
                                leaveFrom="translate-x-0"
                                leaveTo="-translate-x-full"
                            >
                                <div className="relative flex-1 flex flex-col max-w-xs w-full bg-indigo-700">
                                    <Transition.Child
                                        as={Fragment}
                                        enter="ease-in-out duration-300"
                                        enterFrom="opacity-0"
                                        enterTo="opacity-100"
                                        leave="ease-in-out duration-300"
                                        leaveFrom="opacity-100"
                                        leaveTo="opacity-0"
                                    >
                                        <div className="absolute top-0 right-0 -mr-12 pt-2">
                                            <button
                                                type="button"
                                                className="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                                                onClick={() => setSidebarOpen(false)}
                                            >
                                                <span className="sr-only">Close sidebar</span>
                                                <XIcon className="h-6 w-6 text-white" aria-hidden="true" />
                                            </button>
                                        </div>
                                    </Transition.Child>
                                    <div className="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                                        <nav className="px-2 space-y-1">
                                            {navigation.map((item) => (
                                                <NavLink item={item} key={item.name} />
                                            ))}
                                        </nav>
                                    </div>

                                </div>
                            </Transition.Child>
                            <div className="flex-shrink-0 w-14" aria-hidden="true">
                                {/* Force sidebar to shrink to fit close icon */}
                            </div>
                        </Dialog>
                    </Transition.Root>

                    {/* Static sidebar for desktop */}
                    <div className="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
                        {/* Sidebar component, swap this element with another sidebar if you like */}
                        <div className="flex-1 flex flex-col min-h-0 bg-indigo-700">
                            <div className="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                                <nav className="flex-1 px-2 space-y-1">
                                    {navigation.map((item) => (
                                        <NavLink item={item} key={item.name} />
                                    ))}
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div className="md:pl-64 flex flex-col flex-1">
                        <div className="sticky top-0 z-10 md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3 bg-gray-100">
                            <button
                                type="button"
                                className="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                                onClick={() => setSidebarOpen(true)}
                            >
                                <span className="sr-only">Open sidebar</span>
                                <MenuIcon className="h-6 w-6" aria-hidden="true" />
                            </button>
                        </div>
                        <main className="flex-1">
                            <div className="py-6">
                                <div className="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                                    <div className="py-4">
                                        <Routes>
                                            <Route path="farms">
                                                <Route path=":farmID" element={<Farm />}>
                                                    <Route path="turbines">
                                                        <Route path=":turbineID" element={<Turbine />} />
                                                        <Route index element={<Turbines />} />
                                                    </Route>
                                                </Route>
                                                <Route index element={<Farms />} />
                                            </Route>
                                            <Route path="turbines">
                                                <Route path=":turbineID" element={<Turbine />} />
                                                <Route index element={<Turbines />} />
                                            </Route>
                                            <Route path="inspections">
                                                <Route path=":inspectionID" element={<Inspection />} />
                                                <Route index element={<Inspections />} />
                                            </Route>
                                        </Routes>
                                    </div>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
            </>
        </BrowserRouter>
    );
};

App.propTypes = {

};

export default App;
