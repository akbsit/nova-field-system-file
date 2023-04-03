import { TYPE } from './constants';

/**
 * @param {string} type
 *
 * @return {boolean}
 */
export const isImage = (type) => {
  return type === TYPE.IMAGE;
};

/**
 * @param {string} type
 *
 * @return {boolean}
 */
export const isFile = (type) => {
  return type === TYPE.FILE;
};
