import { TYPE } from './constants';

/**
 * @param {string} type
 * @returns {boolean}
 */
export const isImage = (type) => {
  return type === TYPE.IMAGE;
};

/**
 * @param {string} type
 * @returns {boolean}
 */
export const isFile = (type) => {
  return type === TYPE.FILE;
};
