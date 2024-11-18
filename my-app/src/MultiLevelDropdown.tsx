import React, { useState } from 'react';

const MultiLevelDropdown = ({ items }: any) => {
  const [openMenus, setOpenMenus] = useState<any>({});

  const toggleMenu = (key: any) => {
    setOpenMenus((prev: { [x: string]: any; }) => ({ ...prev, [key]: !prev[key] }));
  };

  const renderItems = (menuItems: any, level = 0) => {
    return menuItems.map((item: any, index: any) => {
      const key = `${level}-${index}`;
      const hasChildren = item.children && item.children.length > 0;

      return (
        <li key={key} className="relative">
          <button
            onClick={() => hasChildren && toggleMenu(key)}
            className={`flex items-center justify-between w-full px-4 py-2 text-left hover:bg-gray-100 ${hasChildren ? 'font-semibold' : ''}`}
          >
            {item.name} ({item.product_count})
            {hasChildren && (
              <svg
                className={`w-4 h-4 ml-2 transition-transform ${openMenus[key] ? 'rotate-180' : ''}`}
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 9l-7 7-7-7" />
              </svg>
            )}
        
          </button>
          {hasChildren && openMenus[key] && (
            <ul className="pl-4 mt-2 space-y-2 bg-white rounded-md shadow-lg">
              {renderItems(item.children, level + 1)}
            </ul>
          )}
     
        </li>
      );
    });
  };

  return (
    <div className="relative inline-block text-left">
      <ul className="mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
        {renderItems(items)}
      </ul>
    </div>
  );
};

export default MultiLevelDropdown;